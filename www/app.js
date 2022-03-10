var modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
});
let okButton = document.getElementById("ok");
let sendFaq = () => {
    var email = document.getElementById('email').value;
    var dat = document.getElementById('dat').value;
    axios.post('/api/insert', { data: { dat, email } }).then(r => {
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
    axios.get('/api/getlast5').then(r => {
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

// getFaq();
getYear();


