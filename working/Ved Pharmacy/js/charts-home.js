"use strict";
document.addEventListener("DOMContentLoaded", function () {
    // Main Template Color
    var brandPrimary = "#33b35a";

    // ------------------------------------------------------- //
    // Line Chart
    // ------------------------------------------------------ //
    var LINECHART = document.getElementById("SalesReport");
    var myLineChart = new Chart(LINECHART, {
        type: "bar",
        options: {
            legend: {
                display: false,
            },
        },
        data: {
            labels: SalesDate,
            datasets: [
            {
                label: "Sale Report this year",
                fill: true,
                lineTension: 0.3,
                backgroundColor: "rgba(77, 193, 75, 0.4)",
                borderColor: brandPrimary,
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: "miter",
                borderWidth: 1,
                pointBorderColor: brandPrimary,
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: brandPrimary,
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 0,
                data: SalesAmount,
                spanGaps: false,
            }
            ],
        },
    });


    var LINECHART = document.getElementById("leftitems");
    var myLineChart = new Chart(LINECHART, {
        type: "bar",
        options: {
            legend: {
                display: false,
            },
        },
        data: {
            labels: LeftItemName,
            datasets: [
            {
                label: "Items about to end",
                fill: true,
                lineTension: 0.3,
                backgroundColor: "rgba(77, 193, 75, 0.4)",
                borderColor: brandPrimary,
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: "miter",
                borderWidth: 1,
                pointBorderColor: brandPrimary,
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: brandPrimary,
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 0,
                data: LeftItemQty,
                spanGaps: false,
            }
            ],
        },
    });



    var LINECHART = document.getElementById("ItemAboutExpire");
    var myLineChart = new Chart(LINECHART, {
        type: "bar",
        options: {
            legend: {
                display: false,
            },
        },
        data: {
            labels: ExpItemName,
            datasets: [
            {
                label: "Items about to expire",
                fill: true,
                lineTension: 0.3,
                backgroundColor: "rgba(77, 193, 75, 0.4)",
                borderColor: brandPrimary,
                borderCapStyle: "butt",
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: "miter",
                borderWidth: 1,
                pointBorderColor: brandPrimary,
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: brandPrimary,
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 1,
                pointHitRadius: 0,
                data: LeftExpDays,
                spanGaps: false,
            }
            ],
        },
    });


    // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    var PIECHART = document.getElementById("pieChart");
    var myPieChart = new Chart(PIECHART, {
        type: "doughnut",
        data: {
            labels: ["First", "Second", "Third"],
            datasets: [
            {
                data: [300, 50, 100],
                borderWidth: [1, 1, 1],
                backgroundColor: [brandPrimary, "rgba(75,192,192,1)", "#FFCE56"],
                hoverBackgroundColor: [brandPrimary, "rgba(75,192,192,1)", "#FFCE56"],
            },
            ],
        },
    });

    // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    var MONTHLYPROGRESS = document.getElementById("monthlyProgress");
    var myPieChart = new Chart(MONTHLYPROGRESS, {
        type: "doughnut",
        options: {
            cutoutPercentage: 93,
            responsive: true,
            maintainAspectRatio: true,
            legend: {
                display: false,
            },
        },
        data: {
            labels: ["First", "Second"],
            datasets: [
            {
                data: [300, 50],
                borderWidth: [1, 1],
                backgroundColor: [brandPrimary, "#ffffff"],
                hoverBackgroundColor: [brandPrimary, "#ffffff"],
            },
            ],
        },
    });
});
