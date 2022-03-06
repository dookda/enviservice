
function initializeLiff() {
    liff.init({
        liffId: "1656934660-5WqBNqgW"
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
    document.getElementById("profile").src = await profile.pictureUrl;
    document.getElementById("displayName").innerHTML = await profile.displayName;
    chkAdmin(profile.userId)
}

// var url = 'https://rti2dss.com:3510';
var url = 'https://103c-2001-44c8-45c9-c15c-6854-2ed5-c8b7-6482.ngrok.io';

let chkAdmin = (usrid) => {
    axios.post(url + '/api/getuser', { usrid }).then((r) => {
        r.data.data[0].usertype == 'admin' ? loadData() : $("#modal").modal("show");
    })
}

const deviceUsrid = sessionStorage.getItem("userid");

let gotoHome = () => {
    location.href = "./../index.html";
}

let gotoAdmin = () => {
    location.href = "./../admin/index.html";
    sessionStorage.removeItem("userid");
}

// console.log(deviceUsrid);
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
            url: url + '/api/getdevice/',
            dataSrc: 'data',
            cache: true,
            type: "POST",
            data: { userid: deviceUsrid }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return `<button onclick="deleteData(${data.gid},'${data.device}')" class="btn btn-margin btn-danger" ><i class="bi bi-clipboard-x"></i> ลบ</button>`
                },
            },
            // { data: 'gid' },
            // { data: 'userid' },
            { data: 'device' },
            { data: 'ts' },
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

let insertData = () => {
    // console.log(deviceUsrid);
    let device = document.getElementById("device").value;
    axios.post(url + "/api/insertdevice", { userid: deviceUsrid, device }).then(r => {
        document.getElementById("device").value = "";
        $('#example').DataTable().ajax.reload();
    })
}

let deleteData = (gid, device) => {
    console.log(device);
    $("#gid").val(gid)
    $("#device_id").text(device)
    $("#deleteModal").modal("show")
}

let closeModal = () => {
    // $('#editModal').modal('hide')
    $('#deleteModal').modal('hide');
    // $('#example').DataTable().ajax.reload()
}

let deleteValue = () => {
    // console.log($("#projId").val());
    $("#deleteModal").modal("hide");
    let gid = $("#gid").val();
    axios.post(url + "/api/deletedevice", { gid }).then(r => {
        r.data.data == "success" ? closeModal() : null
        $('#example').DataTable().ajax.reload();
    })
}

initializeLiff()