document.addEventListener("DOMContentLoaded", function () {
    // Format the data directly from Laravel
    function formatDataForChart(data) {
        const dates = Object.keys(data);
        const statusTerlambat = [];
        const statusAlfa = [];
        const statusHadir = [];

        dates.forEach(date => {
            const percentage = data[date];
            statusTerlambat.push(percentage.Terlambat || 0);
            statusAlfa.push(percentage.Alfa || 0);
            statusHadir.push(percentage.Hadir || 0);
        });

        return { dates, statusTerlambat, statusAlfa, statusHadir };
    }

    const chartData = formatDataForChart(dailyStatusCounts);
    initChart(chartData);

    // Initialize the chart
    function initChart({ dates, statusTerlambat, statusAlfa, statusHadir }) {
        const options = {
            series: [
                {
                    name: "Terlambat",
                    data: statusTerlambat,
                    color: "#9ca3af",
                },
                {
                    name: "Alfa",
                    data: statusAlfa,
                    color: "#c81e1e",
                },
                {
                    name: "Hadir",
                    data: statusHadir,
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
                categories: dates, // Use dates from data
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
                        return value + '%';
                    }
                }
            },
        };

        if (document.getElementById("legend-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("legend-chart"), options);
            chart.render();
        }
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Format the data directly from Laravel
    function formatDataForChart(data) {
        const date = Object.keys(data);
        const statusTerlambat = [];
        const statusAlfa = [];
        const statusHadir = [];

        date.forEach(date => {
            const percentages = data[date];
            statusTerlambat.push(percentages.Terlambat || 0);
            statusAlfa.push(percentages.Alfa || 0);
            statusHadir.push(percentages.Hadir || 0);
        });

        return { date, statusTerlambat, statusAlfa, statusHadir };
    }

    const chartData = formatDataForChart(chartStatusCount);
    initChart(chartData);

    // Initialize the chart
    function initChart({ date, statusTerlambat, statusAlfa, statusHadir }) {
        const options = {
            series: [
                {
                    name: "Terlambat",
                    data: statusTerlambat,
                    color: "#9ca3af",
                },
                {
                    name: "Alfa",
                    data: statusAlfa,
                    color: "#c81e1e",
                },
                {
                    name: "Hadir",
                    data: statusHadir,
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
                    show: true,
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
                show: true,
                strokeDashArray: 4,
                padding: {
                    left: 2,
                    right: 2,
                    top: -26
                },
            },
            xaxis: {
                categories: date, // Use dates from data
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
                        return value + '%';
                    }
                }
            },
        };

        if (document.getElementById("legend-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("legend-chart"), options);
            chart.render();
        }
    }
});


