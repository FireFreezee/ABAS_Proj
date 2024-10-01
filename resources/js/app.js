const options = {
    // add data series via arrays, learn more here: https://apexcharts.com/docs/series/
    series: [
        {
            name: "Terlambat",
            data: [1500, 1418, 1456, 1526, 1356, 1256],
            color: "#9ca3af",
        },
        {
            name: "Hadir",
            data: [643, 413, 765, 412, 1423, 1731],
            color: "#0e9f6e",
        },
    ],
    chart: {
        height: "100%",
        maxWidth: "100%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
            enabled: false,
        },
        toolbar: {
            show: false,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
    },
    legend: {
        show: true
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.55,
            opacityTo: 0,
            shade: "#1C64F2",
            gradientToColors: ["#1C64F2"],
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        width: 6,
    },
    grid: {
        show: false,
        strokeDashArray: 4,
        padding: {
            left: 2,
            right: 2,
            top: -26
        },
    },
    xaxis: {
        categories: ['01 February', '02 February', '03 February', '04 February', '05 February', '06 February', '07 February'],
        labels: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
    },
    yaxis: {
        show: false,
        labels: {
            formatter: function (value) {
                return '$' + value;
            }
        }
    },
}

if (document.getElementById("legend-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("legend-chart"), options);
    chart.render();
}
