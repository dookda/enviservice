function initializeLiff() {
    liff.init({
        liffId: "1656934660-zLQobQ78"
    }).then((e) => {
        if (!liff.isLoggedIn()) {
            liff.login();
        } else {
            getUserid();
        }
    }).catch((err) => {
        console.log(err);
    });
}

async function getUserid() {
    const profile = await liff.getProfile();
    // console.log(profile);
    document.getElementById("usrid").value = await profile.userId;
    document.getElementById("profile").src = await profile.pictureUrl;
    document.getElementById("displayName").innerHTML = await profile.displayName;
    chkAdmin(profile.userId)
}

var url = 'https://rti2dss.com/p3510';
// var url = 'https://5639-2001-44c8-45c0-1dbf-c837-b0b-3c03-df5d.ngrok.io';

let chkAdmin = (usrid) => {
    axios.post(url + '/api/getuser', { usrid }).then((r) => {
        r.data.data[0].usertype == 'admin' ? getImg() : $("#modal").modal("show");
    })
}

let gotoHome = () => {
    location.href = "./../index.html"
}

var modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
});
let okButton = document.getElementById("ok");
let sendFaq = () => {
    var email = document.getElementById('email').value;
    var dat = document.getElementById('dat').value;
    axios.post(url + '/api/insert', { data: { dat, email } }).then(r => {
        if (r.data.data == "success") {
            modal.hide()
            getFaq();
        } else {
            document.getElementById('warn').text("เกิดข้อผิดพลาดกรุณาตรวจสอบข้อความอีกครั้ง");
        }
        document.getElementById('dat').value = "";
        document.getElementById('email').value = "";
    });
}

let showModal = () => {
    okButton.removeAttribute("hidden");
    modal.show();
}

let tagetDiv = document.getElementById("quest");
let getFaq = () => {
    tagetDiv.innerHTML = "";
    axios.get(url + '/api/getlast5').then(r => {
        r.data.data.map(i => {
            // console.log(i);
            let lstQuest = `<div class="shadow-none p-3 mb-1 bg-light rounded flex" role="alert">
                                ${i.email} ${i.dat} 
                                <button class="btn btn-info" style="margin-left: auto;" onclick="getDetail(${i.pid}, '${i.email}', '${i.dat}')">รายละเอียด</button>
                            </div>`;
            tagetDiv.innerHTML += lstQuest;
        })
    })
}

let getYear = () => {
    const d = new Date();
    let year = d.getFullYear();
    document.getElementById("year").innerText = year;
}

let reply = () => {

}

let getDetail = (gid, email, dat) => {
    console.log(gid, email, dat);
    document.getElementById("email").value = email;
    document.getElementById("dat").value = dat;
    modal.show();
    okButton.setAttribute("hidden", "hidden");
}

let getImg = () => {
    axios.get(url + '/api/selectpic').then(r => {
        r.data.data.map(i => {
            // console.log(i);
            document.getElementById('preview' + i.gid).src = i.img;
        })
    })
}

let handleFiles = (id) => {
    console.log(id);
    var filesToUploads = document.getElementById('imgfile' + id).files;
    var file = filesToUploads[0];
    var reader = new FileReader();

    reader.onloadend = (e) => {
        let imageOriginal = reader.result;
        resizeImage(id, file);
        document.getElementById('preview' + id).src = imageOriginal;
    }
    reader.readAsDataURL(file);
};

let dataurl = "";
let resizeImage = async (id, file) => {
    var maxW = 600;
    var maxH = 600;
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var img = document.createElement('img');
    var result = '';
    img.onload = async () => {
        var iw = img.width;
        var ih = img.height;
        var scale = Math.min((maxW / iw), (maxH / ih));
        var iwScaled = iw * scale;
        var ihScaled = ih * scale;
        canvas.width = iwScaled;
        canvas.height = ihScaled;
        context.drawImage(img, 0, 0, iwScaled, ihScaled);
        result += canvas.toDataURL('image/jpeg', 0.5);
        dataurl = result;
        // document.getElementById('rez').src = that.imageResize;
        await saveData(id, dataurl)
    }
    img.src = URL.createObjectURL(file);
}

let saveData = (gid, img) => {
    const obj = {
        gid: gid,
        img: img ? img : img = ""
    }

    axios.post(url + '/api/updatepic', obj).then((r) => {
        console.log(r.data);
        // sentMulticast(obj.data.owner_name);
        // modal.show();
    })
};

// getFaq();
getYear();
initializeLiff()

