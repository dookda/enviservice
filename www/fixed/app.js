function initializeLiff() {
    liff.init({
        liffId: "1656934660-P2npAnjg"
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
var url = 'https://rti2dss.com/p3510';
// var url = 'https://103c-2001-44c8-45c9-c15c-6854-2ed5-c8b7-6482.ngrok.io'


let gotoOwnerPost = () => {
    location.href = "./../report_owner/index.html";
}

async function getUserid() {
    const profile = await liff.getProfile();
    document.getElementById("usrid").value = await profile.userId;
    document.getElementById("profile").src = await profile.pictureUrl;
    document.getElementById("displayName").innerText = await profile.displayName;
    // document.getElementById("email").value = await liff.getDecodedIDToken().email;
    console.log(profile);
}

let handleFiles = () => {
    var filesToUploads = document.getElementById('imgfile').files;
    var file = filesToUploads[0];
    var reader = new FileReader();

    reader.onloadend = (e) => {
        let imageOriginal = reader.result;
        resizeImage(file);
        document.getElementById('preview').src = imageOriginal;
    }
    reader.readAsDataURL(file);
};

let dataurl = "";

let modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
});

let input = document.getElementById('imgfile');
input.addEventListener('change', handleFiles);

let resizeImage = (file) => {
    var maxW = 600;
    var maxH = 600;
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var img = document.createElement('img');
    var result = '';
    img.onload = function () {
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
    }
    img.src = URL.createObjectURL(file);
}

let saveData = () => {
    if (!dataurl) {
        dataurl = '-';
    }

    const obj = {
        data: {
            usrid: document.getElementById('usrid').value,
            owner_name: document.getElementById('owner_name').value,
            organize: document.getElementById('organize').value,
            product_type: document.getElementById('product_type').value,
            descr: document.getElementById('descr').value,
            img: dataurl ? dataurl : dataurl = ""
        }
    }

    axios.post(url + '/api/insertfixed', obj).then((res) => {
        // sentMulticast(obj.data.owner_name);
        modal.show();
        setTimeout(() => {
            modal.hide();
            document.getElementById('usrid').value = "";
            document.getElementById('owner_name').value = "";
            document.getElementById('organize').value = "";
            document.getElementById('product_type').value = "";
            document.getElementById('descr').value = ""
            document.getElementById('imgfile').value = "";
            document.getElementById('preview').src = "#";
        }, 2000);
    })
};

initializeLiff()