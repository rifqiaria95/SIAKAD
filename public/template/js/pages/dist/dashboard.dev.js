"use strict";

$(document).ready(function () {
  var options3 = {
    chart: {
      height: 269,
      type: 'bar',
      toolbar: {
        show: false
      }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded',
        borderRadius: 10
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    series: [{
      name: 'Net Profit',
      data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
    }, {
      name: 'Revenue',
      data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
    }, {
      name: 'Free Cash Flow',
      data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
    }],
    xaxis: {
      categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
      labels: {
        style: {
          colors: '#9a9cab'
        }
      }
    },
    yaxis: {
      title: {
        text: '$ (thousands)',
        style: {
          color: '#9a9cab'
        }
      },
      labels: {
        style: {
          colors: '#9a9cab'
        }
      }
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function formatter(val) {
          return "$ " + val + " thousands";
        }
      }
    },
    grid: {
      borderColor: '#9a9cab',
      strokeDashArray: 4
    },
    legend: {
      labels: {
        colors: ['#9a9cab']
      }
    }
  };
});