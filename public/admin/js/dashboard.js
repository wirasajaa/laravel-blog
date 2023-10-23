$(function () {
    // // =====================================
    // // Profit
    // // =====================================
    var chart = {
        series: [
            {
                name: "Uploaded articles:",
                data: articlesTotal,
            },
        ],

        chart: {
            type: "bar",
            height: 345,
            offsetX: -15,
            toolbar: {
                show: true,
            },
            foreColor: "#adb0bb",
            fontFamily: "inherit",
            sparkline: {
                enabled: false,
            },
        },

        colors: ["#5D87FF", "#49BEFF"],

        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "35%",
                borderRadius: [6],
                borderRadiusApplication: "end",
                borderRadiusWhenStacked: "all",
            },
        },
        markers: {
            size: 0,
        },

        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
        },

        grid: {
            borderColor: "rgba(0,0,0,0.1)",
            strokeDashArray: 3,
            xaxis: {
                lines: {
                    show: false,
                },
            },
        },

        xaxis: {
            type: "category",
            categories: articlesLable,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },

        yaxis: {
            show: true,
            min: 0,
            max: articlesMax,
            tickAmount: 4,
            labels: {
                style: {
                    cssClass: "grey--text lighten-2--text fill-color",
                },
            },
        },
        stroke: {
            show: true,
            width: 3,
            lineCap: "butt",
            colors: ["transparent"],
        },

        tooltip: {
            theme: "light",
        },

        responsive: [
            {
                breakpoint: 600,
                options: {
                    plotOptions: {
                        bar: {
                            borderRadius: 3,
                        },
                    },
                },
            },
        ],
    };

    var chart = new ApexCharts(document.querySelector("#chart"), chart);
    chart.render();

    // =====================================
    // Breakup
    // =====================================
    var breakup = {
        color: "#adb5bd",
        series: bestCategoryTotal,
        labels: bestCategoryLabel,
        chart: {
            width: 180,
            type: "donut",
            fontFamily: "Plus Jakarta Sans', sans-serif",
            foreColor: "#adb0bb",
        },
        plotOptions: {
            pie: {
                startAngle: 0,
                endAngle: 360,
                donut: {
                    size: "75%",
                },
            },
        },
        stroke: {
            show: false,
        },

        dataLabels: {
            enabled: false,
        },

        legend: {
            show: false,
        },
        colors: ["#FA896B", "#5D87FF", "#F8D7DA"],

        responsive: [
            {
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            },
        ],
        tooltip: {
            theme: "dark",
            fillSeriesColor: false,
        },
    };

    var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
    chart.render();

    // =====================================
    // Earning
    // =====================================
    // var earning = {
    //     chart: {
    //         id: "sparkline3",
    //         type: "area",
    //         height: 300,
    //         sparkline: {
    //             enabled: false,
    //         },
    //         group: "sparklines",
    //         fontFamily: "Plus Jakarta Sans', sans-serif",
    //         foreColor: "#adb0bb",
    //     },
    //     series: [
    //         {
    //             name: "Uploaded Articles",
    //             color: "#49BEFF",
    //             data: uploadTotal,
    //         },
    //     ],
    //     stroke: {
    //         curve: "smooth",
    //         width: 2,
    //     },
    //     fill: {
    //         colors: ["#f3feff"],
    //         type: "solid",
    //         opacity: 0.15,
    //     },

    //     markers: {
    //         size: 0,
    //     },
    //     tooltip: {
    //         theme: "dark",
    //         fixed: {
    //             enabled: true,
    //             position: "right",
    //         },
    //         x: {
    //             show: true,
    //         },
    //     },
    // };
    let earning = {
        series: [
            {
                name: "Total",
                color: "#49BEFF",
                data: uploadTotal,
            },
        ],
        chart: {
            height: "auto",
            type: "area",
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
            width: 3,
        },
        xaxis: {
            type: "string",
            categories: uploadCategory,
        },
        yaxis: {
            min: 0,
            max: parseInt(uploadMax),
            labels: {
                formatter: function (val) {
                    return parseInt(val) === val ? val : "";
                },
            },
        },
        markers: {
            size: 5,
        },
    };
    new ApexCharts(document.querySelector("#earning"), earning).render();
});
