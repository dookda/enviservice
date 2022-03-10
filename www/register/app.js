function initializeLiff() {
    liff.init({
        liffId: "1656934660-8AB2mBrE"
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
// var url = 'http://localhost:3000'

let getData = (usrid) => {
    axios.post(url + "/api/getuser", { usrid }).then((r) => {
        // console.log(r);
        if (r.data.data.length > 0) {
            document.getElementById("username").value = r.data.data[0].username;
            document.getElementById("agency").value = r.data.data[0].agency;
            document.getElementById("email").value = r.data.data[0].email;
            document.getElementById("tel").value = r.data.data[0].tel;
        }
    })
}
let modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
})
let updateUser = () => {
    let obj = {
        usrid: document.getElementById("usrid").value,
        data: {
            username: document.getElementById("username").value,
            agency: document.getElementById("agency").value,
            email: document.getElementById("email").value,
            tel: document.getElementById("tel").value,
            displayname: document.getElementById("displayName").value
        }
    }
    console.log(obj);
    axios.post(url + "/api/updateuser", obj).then((r) => {
        // console.log(r);
        modal.show();
        getData(usrid)
        setTimeout(() => {
            modal.hide();
        }, 2000);
    })
}

let gotoOwnerPost = () => {
    location.href = "./../report_owner/index.html";
}

async function getUserid() {
    const profile = await liff.getProfile();
    document.getElementById("usrid").value = await profile.userId;
    document.getElementById("profile").src = await profile.pictureUrl;
    document.getElementById("displayName").innerText = await profile.displayName;
    // document.getElementById("email").value = await liff.getDecodedIDToken().email;
    // console.log(profile);
    getData(await profile.userId)
}
initializeLiff()