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
var url = 'https://rti2dss.com:3510';
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

let chart = () => {
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
    cursor.lineY.set("visible", false);

    // Generate random data
    var date = new Date();
    date.setHours(0, 0, 0, 0);
    var value = 100;

    function generateData() {
        value = Math.round(Math.random() * 10 - 5 + value);

        am5.time.add(date, "day", 1);
        return { date: date.getTime(), value: value };
    }

    function generateDatas(count) {
        var data = [];
        for (var i = 0; i < count; ++i) {
            data.push(generateData());
        }
        return data;
    }

    // Create axes
    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
    var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
        baseInterval: { timeUnit: "day", count: 1 },
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
        valueYField: "value",
        valueXField: "date",
        tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
        })
    }));


    // Add scrollbar
    // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
    var scrollbar = chart.set("scrollbarX", am5xy.XYChartScrollbar.new(root, {
        orientation: "horizontal",
        height: 60
    }));

    var sbDateAxis = scrollbar.chart.xAxes.push(am5xy.DateAxis.new(root, {
        baseInterval: {
            timeUnit: "day",
            count: 1
        },
        renderer: am5xy.AxisRendererX.new(root, {})
    }));

    var sbValueAxis = scrollbar.chart.yAxes.push(
        am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, {})
        })
    );

    var sbSeries = scrollbar.chart.series.push(am5xy.LineSeries.new(root, {
        valueYField: "value",
        valueXField: "date",
        xAxis: sbDateAxis,
        yAxis: sbValueAxis
    }));

    var data = generateDatas(2000);
    // console.log(data);
    series.data.setAll(data);
    sbSeries.data.setAll(data);

    // Make stuff animate on load
    // https://www.amcharts.com/docs/v5/concepts/animations/
    // series.appear(1000);
    // chart.appear(1000, 100);
}


let loadData = () => {
    axios.get(`/api/iotdata`).then(r => {

        let a = r.data.map(i => i.data);
        console.log(a);
    })
}


initializeLiff();
chart();
// loadData()