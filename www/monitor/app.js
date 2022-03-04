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
// var url = 'https://rti2dss.com:3510';
var url = 'https://103c-2001-44c8-45c9-c15c-6854-2ed5-c8b7-6482.ngrok.io'


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

let chart = (data) => {
    // Create root element
    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
    var root = am5.Root.new("chartdiv");

    // Set themes
    // https://www.amcharts.com/docs/v5/concepts/themes/
    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    // Create chart
    // https://www.amcharts.com/docs/v5/charts/xy-chart/
    var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX"
    }));

    // Add cursor
    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
        // behavior: "none"
        behavior: "zoomX"
    }));
    cursor.lineY.set("visible", true);

    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
        baseInterval: { timeUnit: "second", count: 1 },
        renderer: am5xy.AxisRendererX.new(root, {}),
        tooltip: am5.Tooltip.new(root, {})
    }));

    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererY.new(root, {})
    }));

    // Add series
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
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

    // Add circle bullet
    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/#Bullets
    series.bullets.push(function () {
        var graphics = am5.Circle.new(root, {
            strokeWidth: 2,
            radius: 5,
            stroke: series.get("stroke"),
            fill: root.interfaceColors.get("background"),
        });

        // graphics.adapters.add("radius", function (radius, target) {
        //     return target.dataItem.dataContext.townSize;
        // })

        return am5.Bullet.new(root, {
            sprite: graphics
        });
    });

    // var data = generateDatas(2000);
    series.data.setAll(data);
}

let loadData = () => {
    axios.get(`/api/iotdata`).then(r => {
        console.log(r.data);
        chart(r.data)
    })
}


initializeLiff();
// chart();
loadData()