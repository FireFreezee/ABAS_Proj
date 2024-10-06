document.addEventListener("DOMContentLoaded", function () {
    // Format the data directly from Laravel
    function formatDataForChart(data) {
        const dates = Object.keys(data);
        const statusTerlambat = [];
        const statusAlfa = [];
        const statusHadir = [];

        dates.forEach(date => {
            const dayData = data[date];
            statusTerlambat.push(dayData.Terlambat || 0);
            statusAlfa.push(dayData.Alfa || 0);
            statusHadir.push(dayData.Hadir || 0);
        });

        return { dates, statusTerlambat, statusAlfa, statusHadir };
    }

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
                        return value + ' Siswa';
                    }
                }
            },
        };

        if (document.getElementById("legend-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("legend-chart"), options);
            chart.render();
        }
    }

    // Pass dailyStatusCounts directly to chart initialization
    const chartData = formatDataForChart(dailyStatusCounts);
    initChart(chartData);
});
