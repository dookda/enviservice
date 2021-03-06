function initializeLiff() {
    liff.init({
        liffId: "1656934660-QndaYdr0"
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
// var url = 'https://57a3-202-28-250-95.ngrok.io';

let gotoOwnerPost = () => {
    location.href = "./../report_owner/index.html";
}

async function getUserid() {
    const profile = await liff.getProfile();
    document.getElementById("usrid").value = await profile.userId;
    document.getElementById("profile").src = await profile.pictureUrl;
    document.getElementById("displayName").innerText = await profile.displayName;
    deviceList()
}

var root = am5.Root.new("chartdiv");
root.setThemes([
    am5themes_Animated.new(root)
]);
var chart = root.container.children.push(am5xy.XYChart.new(root, {
    panX: true,
    panY: true,
    wheelX: "panX",
    wheelY: "zoomX"
}));

var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
    // behavior: "none"
    behavior: "zoomX"
}));
cursor.lineY.set("visible", true);
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
    baseInterval: { timeUnit: "minute", count: 1 },
    renderer: am5xy.AxisRendererX.new(root, {}),
    tooltip: am5.Tooltip.new(root, {})
}));

xAxis.children.push(am5.Label.new(root, { text: "วัน เวลา", x: am5.p50, centerX: am5.p50, fontFamily: 'Kanit' }));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
    renderer: am5xy.AxisRendererY.new(root, {})
}));

yAxis.children.moveValue(am5.Label.new(root, { text: "ความดัง (dB)", rotation: -90, y: am5.p50, centerX: am5.p50, fontFamily: 'Kanit' }), 0);

var series = chart.series.push(am5xy.LineSeries.new(root, {
    name: "Series",
    xAxis: xAxis,
    yAxis: yAxis,
    valueYField: "lmax",
    valueXField: "dt",
    tooltip: am5.Tooltip.new(root, {
        labelText: "{valueY}"
    })
}));

series.data.processor = am5.DataProcessor.new(root, {
    dateFormat: "yyyy-MM-dd HH:mm:ss",
    dateFields: ["dt"]
});

series.strokes.template.setAll({ strokeWidth: 2 });
// series.bullets.push(function () {
//     var graphics = am5.Circle.new(root, {
//         strokeWidth: 2,
//         radius: 5,
//         stroke: series.get("stroke"),
//         fill: root.interfaceColors.get("background"),
//     });

//     return am5.Bullet.new(root, {
//         sprite: graphics
//     });
// });

let chart5 = (data) => {
    series.data.setAll(data);
}

let getData = (device, dstart, dend) => {
    // console.log(dstart, dend);
    axios.post(url + '/api/iotdata', { device, dstart, dend }).then(r => {
        if (r.data.data !== "nodata") {
            let lmax = _.maxBy(r.data, 'lmax');
            let dt = moment(lmax.dt).format('DD-MM-YYYY HH:mm:ss')
            document.getElementById("lmax").innerHTML = lmax.lmax;
            document.getElementById("ldate").innerHTML = dt;

            chart5(r.data)
        } else {
            document.getElementById("deviceNodata").innerHTML = device
            modal.show();
            setTimeout(() => {
                modal.hide();
            }, 2000);
        }
    })
}

let loadData = () => {
    let device = document.getElementById("device").value;
    let dstart = document.getElementById("dstart").value + "T00:00:00Z";
    let dend = document.getElementById("dend").value + "T23:59:00Z";
    getData(device, dstart, dend)
}
let modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
})
let deviceList = () => {
    let userid = document.getElementById("usrid").value;
    axios.post(url + "/api/getdevice", { userid }).then(r => {
        if (r.data.data.length > 0) {
            document.getElementById("default_device").value = r.data.data[0].device
            r.data.data.map(i => {
                document.getElementById("device").innerHTML += `<option value="${i.device}">อุปกรณ์หมายเลข ${i.device}</option>`
            })
            setTimeout(() => {
                getInit()
            }, 500);
        }
    });
}

const d = new Date();
const getInit = () => {
    let currentDate = d.toISOString().substring(0, 10);
    console.log(d);
    document.getElementById('dstart').value = currentDate;
    document.getElementById('dend').value = currentDate;
    let device = document.getElementById("default_device").value
    let dstart = `${currentDate}T00:00:00Z`;
    let dend = `${currentDate}T23:59:00Z`;
    // console.log(dstart, dend);
    getData(device, dstart, dend);
}

initializeLiff();





