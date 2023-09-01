//vars for page
var veryLow = 0;
var low = 0;
var mediumLow = 0;
var medium = 0;
var high = 0;
var veryHigh = 0;

var veryLowInitial = 0;
var lowInitial = 0;
var mediumLowInitial = 0;
var mediumInitial = 0;
var highInitial = 0;
var veryHighInitial = 0;

var highPositiveRate = 0;
var veryHighPositiveRate = 0;
var highRate = 0;
var veryHighRate = 0;

var totalFraudNumbers = 0;

var numberOfNumbers = 0; //parseInt($("#numberOfNumbers").val());
var initialNumberOfNumbers = 0;
var periodMultiplier = 1;

var averageValOfTransaction = 0;
var fraudAvoidedBy = 0;

var monthlyCost = 0;
var otherCostsAllNumbers = 0;
var otherCostsFraudNumbers = 0;
var totalCost = 0;

var costPerPhone = 0;
var averageSMS = 0;
var otherSavings = 0;
var totalSavings = 0;

var roi = 0;

//on page load
var finishedLoading = false;
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Datepicker == 'undefined') {
        console.warn('Warning - datepicker.min.js is not loaded.');
        return;
    }
    const dpAutoHideElement = document.querySelector('.pick-date-basic');
    if(dpAutoHideElement) {
        const dpAutoHide = new Datepicker(dpAutoHideElement, {
            container: '.content-inner',
            buttonClass: 'btn',
            prevArrow: document.dir === 'rtl' ? '&rarr;' : '&larr;',
            nextArrow: document.dir === 'rtl' ? '&larr;' : '&rarr;',
            autohide: true
        });
    }
    const dpOneSideElement = document.querySelector('.datepicker-range-one-side');
    if(dpOneSideElement) {
        const dpOneSide = new DateRangePicker(dpOneSideElement, {
            container: '.content-inner',
            buttonClass: 'btn',
            prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
            nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
            allowOneSidedRange: false
        });
    }


    if (typeof echarts == 'undefined') {
        console.warn('Warning - echarts.min.js is not loaded.');
        return;
    }

    var triggerChartResize = function() {
        line_zoom_element && line_zoom.resize();
    };

    var sidebarToggle = document.querySelectorAll('.sidebar-control');
    if (sidebarToggle) {
        sidebarToggle.forEach(function(togglers) {
            togglers.addEventListener('click', triggerChartResize);
        });
    }

    var resizeCharts;
    window.addEventListener('resize', function() {
        clearTimeout(resizeCharts);
        resizeCharts = setTimeout(function () {
            triggerChartResize();
        }, 200);
    });

    initialNumberOfNumbers = parseInt($("#initialNumberOfNumbers").val());

    calculate();
    finishedLoading = true;
});


function calculate(){
    //calculate table
    periodMultiplier = parseInt($("#periodMultiplier").val());
    veryLow = parseInt($("#veryLow").data("initial")) * periodMultiplier;
    low = parseInt($("#low").data("initial")) * periodMultiplier;
    mediumLow = parseInt($("#mediumLow").data("initial")) * periodMultiplier;
    medium = parseInt($("#medium").data("initial")) * periodMultiplier;
    high = parseInt($("#high").data("initial")) * periodMultiplier;
    veryHigh = parseFloat($("#veryHigh").data("initial")) * periodMultiplier;
    numberOfNumbers = veryLow + low + mediumLow + medium + high + veryHigh;
    $("#veryLow").val(veryLow);
    $("#low").val(low);
    $("#mediumLow").val(mediumLow);
    $("#medium").val(medium);
    $("#high").val(high);
    $("#veryHigh").val(veryHigh);
    $("#numberOfNumbers").val(numberOfNumbers);

    //calculate frauds
    highPositiveRate = parseInt($("#highPositiveRate").val());
    veryHighPositiveRate = parseInt($("#veryHighPositiveRate").val());
    highRate = Math.round(high * (highPositiveRate/100));
    veryHighRate = Math.round(veryHigh * (veryHighPositiveRate/100));
    totalFraudNumbers = highRate + veryHighRate;
    $("#highPositiveRateNumbers").val(highRate);
    $("#veryHighPositiveRateNumbers").val(veryHighRate);
    $("#totalFraudNumbers").val(totalFraudNumbers);
    if(!finishedLoading){
        $("#transactionAvoided").val(totalFraudNumbers);
    }
    
    //fraud avoided by
    var fraudNumbersForm = parseInt($("#transactionAvoided").val());
    averageValOfTransaction = parseFloat($("#averageValOfTransaction").val()).toFixed(2);
    fraudAvoidedBy = fraudNumbersForm * averageValOfTransaction;
    $("#fraudAvoidedBy").val(fraudAvoidedBy);

    //total cost
    monthlyCost = parseFloat($("#monthlyCost").val());
    otherCostsAllNumbers = parseFloat($("#otherCostsAllNumbers").val());
    otherCostsFraudNumbers = parseFloat($("#otherCostsFraudNumbers").val());
    totalCost = monthlyCost + otherCostsAllNumbers * numberOfNumbers + otherCostsFraudNumbers * totalFraudNumbers;
    $("#totalCost").val(totalCost);

    //total savings
    costPerPhone = parseFloat($("#costPerPhone").val());
    averageSMS = parseFloat($("#averageSMS").val());
    otherSavings = parseFloat($("#otherSavings").val());
    $("#totalPerPhone").val(parseFloat(costPerPhone * numberOfNumbers).toFixed(4));
    $("#totalSMS").val(parseFloat(averageSMS * totalFraudNumbers).toFixed(4));
    totalSavings = parseFloat(otherSavings + averageSMS * totalFraudNumbers + costPerPhone * numberOfNumbers).toFixed(4);
    $("#totalSavings").val(totalSavings);

    //roi
    roi = parseFloat(totalSavings) + parseFloat(fraudAvoidedBy) - parseFloat(totalCost);
    drawLines();
    $("#roi").val(roi.toFixed(2));
}
function dateRange(startDate, endDate, steps = 1) {
  const dateArray = [];
  let currentDate = new Date(startDate);

  while (currentDate <= new Date(endDate)) {
    dateArray.push(new Date(currentDate));
    // Use UTC date to prevent problems with time zones and DST
    currentDate.setUTCDate(currentDate.getUTCDate() + steps);
  }

  return dateArray;
}
function drawLines(){
    // console.log('draw');
    line_zoom_element = document.getElementById('line_zoom');

    var dataForXaxis = [];
    var dataSerisCost = [];
    var dataSerisSavings = [];

    var periodFrom = $("#periodFrom").val().split('/');
    var periodTo = $("#periodTo").val().split('/');
    var dateFrom = new Date(parseInt(periodFrom[2]), parseInt(periodFrom[0])-1, parseInt(periodFrom[1]));
    var dateTo = new Date(parseInt(periodTo[2]), parseInt(periodTo[0])-1, parseInt(periodTo[1]));
    var numberOfDays = Math.round((dateTo - dateFrom) / (24 * 60 * 60 * 1000));

    //totalCost
    //roi

    var total = totalCost + roi;
    var incrementValue = parseFloat(total/numberOfDays);

    var tmpSavings = 0;
    var tmpCost = totalCost;
    var monthCount = 1;

    const dates = dateRange(dateFrom, dateTo);
    dates.forEach(function(value, index){
        var newXaxis = (value.getMonth()+1)+"/"+value.getDate()+"/"+value.getFullYear();
        dataForXaxis.push(newXaxis);
        dataSerisSavings.push(parseFloat(tmpSavings).toFixed(2));
        tmpSavings += incrementValue;
        if(value.getDate() === 1 && index !== 0){
            monthCount++;
            tmpCost = totalCost * monthCount;
        }
        dataSerisCost.push(tmpCost);
    })

    // console.log(dataSerisSavings);
    // console.log("dateFrom",dateFrom);
    // console.log("dateTo",dateTo);
    // console.log("numberOfDays",numberOfDays);
    // console.log("dataForXaxis",dataForXaxis);

    if (line_zoom_element) {
        line_zoom = echarts.init(line_zoom_element, null, { renderer: 'svg' });

        line_zoom.setOption({

            // Define colors
            color: ["#d74e67", "#4fc686"],

            // Global text styles
            textStyle: {
                fontFamily: 'var(--body-font-family)',
                color: 'var(--body-color)',
                fontSize: 14,
                lineHeight: 22,
                textBorderColor: 'transparent'
            },

            // Chart animation duration
            animationDuration: 750,

            // Setup grid
            grid: {
                left: 10,
                right: 30,
                top: 35,
                bottom: 60,
                containLabel: true
            },

            // Add legend
            legend: {
                data: ['Costs', 'Savings'],
                itemHeight: 8,
                itemGap: 30,
                textStyle: {
                    color: 'var(--body-color)'
                }
            },

            // Add tooltip
            tooltip: {
                trigger: 'axis',
                className: 'shadow-sm rounded',
                backgroundColor: 'var(--white)',
                borderColor: 'var(--gray-400)',
                padding: 15,
                textStyle: {
                    color: '#000'
                }
            },

            // Horizontal axis
            xAxis: [{
                type: 'category',
                boundaryGap: false,
                axisLabel: {
                    color: 'rgba(var(--body-color-rgb), .65)'
                },
                axisLine: {
                    lineStyle: {
                        color: 'var(--gray-500)'
                    }
                },
                splitLine: {
                    show: true,
                    lineStyle: {
                        color: 'var(--gray-300)'
                    }
                },
                data: dataForXaxis
            }],

            // Vertical axis
            yAxis: [{
                type: 'value',
                axisLabel: {
                    formatter: '{value} ',
                    color: 'rgba(var(--body-color-rgb), .65)'
                },
                axisLine: {
                    show: true,
                    lineStyle: {
                        color: 'var(--gray-500)'
                    }
                },
                splitLine: {
                    lineStyle: {
                        color: 'var(--gray-300)'
                    }
                },
                splitArea: {
                    show: true,
                    areaStyle: {
                        color: ['rgba(var(--white-rgb), .01)', 'rgba(var(--black-rgb), .01)']
                    }
                }
            }],

            // Zoom control
            dataZoom: [
                {
                    type: 'inside',
                    start: 0,
                    end: 100
                },
                {
                    show: true,
                    type: 'slider',
                    start: 30,
                    end: 70,
                    height: 40,
                    bottom: 10,
                    borderColor: 'var(--gray-400)',
                    fillerColor: 'rgba(0,0,0,0.05)',
                    textStyle: {
                        color: 'var(--body-color)'
                    },
                    handleStyle: {
                        color: '#8fb0f7',
                        borderColor: 'rgba(0,0,0,0.25)'
                    },
                    moveHandleStyle: {
                        color: '#8fb0f7',
                        borderColor: 'rgba(0,0,0,0.25)'
                    },
                    dataBackground: {
                        lineStyle: {
                            color: 'var(--gray-500)'
                        },
                        areaStyle: {
                            color: 'var(--gray-500)',
                            opacity: 0.1
                        }
                    }
                }
            ],

            // Add series
            series: [
                {
                    name: 'Costs',
                    type: 'line',
                    smooth: true,
                    symbol: 'circle',
                    symbolSize: 18,
                    data: dataSerisCost,
                    lineStyle: {
                        width: 8
                    },
                },
                {
                    name: 'Savings',
                    type: 'line',
                    smooth: true,
                    symbol: 'circle',
                    symbolSize: 18,
                    data: dataSerisSavings,
                    lineStyle: {
                        width: 8
                    },
                }
            ]
        });
    }
}