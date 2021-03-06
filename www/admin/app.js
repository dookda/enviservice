function initializeLiff() {
    liff.init({
        liffId: "1656934660-MaWk0W1e"
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
        r.data.data[0].usertype == 'admin' ? loadData() : $("#modal").modal("show");
    })
}

let gotoHome = () => {
    location.href = "./../index.html"
}

let gotoDevice = (userid) => {
    location.href = "./../device/index.html"
    sessionStorage.setItem("userid", userid)
}

let loadData = async () => {
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง_MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(ทั้งหมด _MAX_ แถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "เริ่มต้น",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "สุดท้าย"
            }
        }
    });
    let table = $('#example').DataTable({
        ajax: {
            url: url + '/api/getalluser/',
            dataSrc: 'data',
            cache: true,
            type: "POST",
            data: { usrid: "aaa" }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return `
                    <button onclick="gotoDevice('${data.usrid}')" class="btn btn-margin btn-warning" ><i class="bi bi-file-earmark-person"></i> จัดการอุปกรณ์</button>
                    <button onclick="deleteData(${data.gid},'${data.username}')" class="btn btn-margin btn-danger" ><i class="bi bi-clipboard-x"></i> ลบ</button>`
                },
            },
            { data: 'gid' },
            { data: 'username' },
            { data: 'agency' },
            { data: 'email' },
            { data: 'tel' },
            { data: 'usertype' },
        ],
        // dom: 'Bfrtip',
        // buttons: [
        //     'excel', 'print'
        // ],
        responsive: true,
        scrollX: true,
        paging: false,
    });

    table.on('search.dt', () => {
        let data = table.rows({ search: 'applied' }).data();
        // console.log(data);
        // showMap(data)
        // groupTam(data)
    });

    let findData = function () {
        console.log(this.value);
        table.search(this.value).draw();
    }
}

let editData = (gid) => {
    location.href = "./../edit/index.html?gid=" + gid;
}

let deleteData = (gid, username) => {
    $("#gid").val(gid)
    $("#username").text(username)
    $("#deleteModal").modal("show")
}

let closeModal = () => {
    // $('#editModal').modal('hide')
    $('#deleteModal').modal('hide');
}

let deleteValue = () => {
    // console.log($("#projId").val());
    $("#deleteModal").modal("hide");
    let gid = $("#gid").val();
    axios.post(url + "/api/delete", { gid }).then(r => {
        r.data.data == "success" ? closeModal() : null
        $('#example').DataTable().ajax.reload();
    })
}

initializeLiff()