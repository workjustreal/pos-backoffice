/*
Template Name: Ubold - Responsive Bootstrap 4 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Dashboard 1 init
*/

//
// Total Revenue
//
var colors = ["#f1556c"];
var dataColors = $("#total-revenue").data("colors");
if (dataColors) {
    colors = dataColors.split(",");
}
var options = {
    series: [document.getElementById("percent").value],
    chart: {
        height: 242,
        type: "radialBar",
    },
    plotOptions: {
        radialBar: {
            hollow: {
                size: "65%",
            },
        },
    },
    colors: colors,
    labels: ["รายได้"],
};

var chart = new ApexCharts(document.querySelector("#total-revenue"), options);
chart.render();

//
// Sales Analytics
//
var colors = ["#1abc9c", "#4a81d4"];
var dataColors = $("#sales-analytics").data("colors");
if (dataColors) {
    colors = dataColors.split(",");
}
const now = new Date();

const start = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 12);
const end = new Date();
let loop = new Date(start);
const dayofweek = [];
const twoweek = [];
const qty = [];

while (loop <= end) {
    dayofweek.push(
        loop
            .toLocaleDateString("en-us", {
                day: "numeric",
                month: "short",
                year: "numeric",
            })
            .toString()
    );
    let newDate = loop.setDate(loop.getDate() + 1);
    loop = new Date(newDate);
}

for ($i = 0; $i <= 12; $i++) {
    twoweek.push(document.getElementById("twoweek" + $i).value);
    qty.push(document.getElementById("qty" + $i).value);
}

var options = {
    series: [
        {
            name: "ขายได้ ฿",
            type: "column",
            data: twoweek,
        },
        {
            name: "จำนวนสินค้า",
            type: "line",
            data: qty,
        },
    ],
    chart: {
        height: 378,
        type: "line",
        offsetY: 10,
    },
    stroke: {
        width: [2, 3],
    },
    plotOptions: {
        bar: {
            columnWidth: "50%",
        },
    },
    colors: colors,
    dataLabels: {
        enabled: true,
        enabledOnSeries: [1],
    },
    labels: dayofweek,
    xaxis: {
        type: "datetime",
    },
    legend: {
        offsetY: 7,
    },
    grid: {
        padding: {
            bottom: 20,
        },
    },
    fill: {
        type: "gradient",
        gradient: {
            shade: "light",
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.75,
            opacityTo: 0.75,
            stops: [0, 0, 0],
        },
    },
    yaxis: [
        {
            title: {
                text: "ราคาขาย",
            },
        },
        {
            opposite: true,
            title: {
                text: "จำนวนชิ้น",
            },
        },
    ],
};

var chart = new ApexCharts(document.querySelector("#sales-analytics"), options);
chart.render();

// Datepicker
// $("#dash-daterange").flatpickr({
//     altInput: true,
//     mode: "range",
//     altFormat: "F j, y",
//     defaultDate: "today",
// });

function getLastWeeksDate() {
    const now = new Date();

    return new Date(
        now.getFullYear(),
        now.getMonth(),
        now.getDate() - 14
    ).toDateString();
}
