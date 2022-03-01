function initializeLiff() {
    liff.init({
        liffId: "1656619414-wm54OVq5"
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
    document.getElementById("usrid").value = await profile.userId;
    document.getElementById("profile1").src = await profile.pictureUrl;
    document.getElementById("displayName1").innerHTML = await profile.displayName;
    document.getElementById("profile2").src = await profile.pictureUrl;
    document.getElementById("displayName2").innerHTML = await profile.displayName;
    chkAdmin(await profile.userId)
}

// var url = 'http://localhost:3000';
// var url = 'https://thailandbioenergyhub.com:3000';

let updateUser = () => {
    let usrid = document.getElementById("usrid").value;
    let data = {
        sname: document.getElementById("sname").value,
        organize: document.getElementById("organize").value,
        tel: document.getElementById("tel").value
    }
    axios.post("/api/updateuser", { usrid, data }).then(r => {
        console.log(r);
    })
}

initializeLiff();