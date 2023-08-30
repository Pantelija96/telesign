var line_zoom = null;
var finishedLoading = false;

document.addEventListener('DOMContentLoaded', function() {
    calculateFraudNumbers();
    calculateFraudAvoidedBy();
    calculateTotalCost();
    calculateTotalSMS();
    calculatePerPhone();
    calculateTotalSavings();
    calculateROI();

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

    var line_zoom_element = document.getElementById('line_zoom');

    if (line_zoom_element) {
        line_zoom = echarts.init(line_zoom_element, null, { renderer: 'svg' });

        var periodFrom = $("#periodFrom").val().split('/');
        var periodTo = $("#periodTo").val().split('/');

        var dateFrom = new Date(parseInt(periodFrom[2]), parseInt(periodFrom[0])-1, parseInt(periodFrom[1]));
        var dateTo = new Date(parseInt(periodTo[2]), parseInt(periodTo[0])-1, parseInt(periodTo[1]));

        var numberOfDays = Math.round((dateTo - dateFrom) / (24 * 60 * 60 * 1000));

        console.log("dateFrom",dateFrom);
        console.log("dateTo",dateTo);
        console.log("numberOfDays",numberOfDays);

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
                data: ['2020','2021','3/2021','2022','2023', '2004', '2005']
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
                    data: [5000,5000,5000,5000,5000,5000],
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
                    data: [1000,3000,5000,7000,9000,11000],
                    lineStyle: {
                        width: 8
                    },
                }
            ]
        });
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


    finishedLoading = true;
});
function calculateFraudNumbers(){
    var periodMultiplier = parseInt($("#periodMultiplier").val());

    var veryLowNumbers = parseInt($("#veryLowNumbers").val()) * periodMultiplier;
    var lowNumbers = parseInt($("#lowNumbers").val()) * periodMultiplier;
    var mediumLow = parseInt($("#mediumLowNumbers").val()) * periodMultiplier;
    var mediumNumbers = parseInt($("#mediumNumbers").val()) * periodMultiplier;
    var highNumbers = parseInt($("#highNumbers").val()) * periodMultiplier;
    var veryHighNumbers = parseFloat($("#veryHighNumbers").val()) * periodMultiplier;
    var totalNumbers = veryLowNumbers + lowNumbers + mediumLow + mediumNumbers + highNumbers + veryHighNumbers;

    var highNumbersPositiveRate = parseInt($("#highPositiveRate").val());
    var veryHighNumbersPositiveRate = parseInt($("#veryHighPositiveRate").val());

    var highRate = Math.round(highNumbers * (highNumbersPositiveRate/100));
    var veryHighRate = Math.round(veryHighNumbers * (veryHighNumbersPositiveRate/100));

    $("#very-low").html(veryLowNumbers);
    $("#low").html(lowNumbers);
    $("#medium-low").html(mediumLow);
    $("#medium").html(mediumNumbers);
    $("#high").html(highNumbers);
    $("#very-high").html(veryHighNumbers);
    $("#totalNumbers").html(totalNumbers);

    $("#highPositiveRateNumbers").val(highRate);
    $("#veryHighPositiveRateNumbers").val(veryHighRate);
    $("#totalFraudNumbers").html(highRate+veryHighRate);
    $("#totalFraudNumbersHidden").val(highRate+veryHighRate);
    $("#transactionAvoided").val(highRate+veryHighRate);
    $("#totalNumbersHidden").val(totalNumbers);
    if(finishedLoading){
        calculateFraudAvoidedBy();
        calculateTotalCost();
    }
}
function calculateFraudAvoidedBy() {
    var scamNumbers = parseInt($("#transactionAvoided").val());
    var averageValue = parseFloat($("#averageValOfTrans").val());

    var fraudAvoidedBy = scamNumbers * averageValue;
    $("#fraudAvoidedBy").val(fraudAvoidedBy);

    if(finishedLoading){
        calculateTotalSMS();
        calculateROI();
    }
}
function calculateTotalCost(){
    var numberOfNumbers = parseInt($("#totalNumbersHidden").val());
    var monthlyCost = parseFloat($("#monthlyCost").val());
    var otherCostsAllNumbers = parseFloat($("#otherCostsAllNumbers").val());
    var otherCostsFraudNumbers = parseFloat($("#otherCostsFraudNumbers").val());

    var highPositiveRateNumbers = parseInt($("#highPositiveRateNumbers").val());
    var veryHighPositiveRateNumbers = parseInt($("#veryHighPositiveRateNumbers").val());
    var fraudNumbers = highPositiveRateNumbers + veryHighPositiveRateNumbers;

    var totalCost = monthlyCost + otherCostsAllNumbers*numberOfNumbers + fraudNumbers*otherCostsFraudNumbers;

    $("#totalCost").val(totalCost);

    if(finishedLoading){
        calculateROI();
    }
}
function calculateTotalSMS(){
    var highPositiveRateNumbers = parseInt($("#highPositiveRateNumbers").val());
    var veryHighPositiveRateNumbers = parseInt($("#veryHighPositiveRateNumbers").val());
    var fraudNumbers = highPositiveRateNumbers + veryHighPositiveRateNumbers;
    var averageSMS = parseFloat($("#averageSMS").val());

    var totalSMS = averageSMS * fraudNumbers;
    $("#totalSMS").val(totalSMS);
    calculateTotalSavings();
}
function calculatePerPhone(){
    var numberOfNumbers = parseInt($("#totalNumbersHidden").val());
    var costPerPhone = parseFloat($("#costPerPhone").val());

    var totalPerPhone = costPerPhone * numberOfNumbers;
    $("#totalPerPhone").val(totalPerPhone);
    calculateTotalSavings();
}
function calculateTotalSavings(){
    var savingsPhone = parseFloat($("#totalPerPhone").val());
    var savingsSms = parseFloat($("#totalSMS").val());
    var otherSavings = parseFloat($("#otherSavings").val());

    var totalSavings = savingsPhone + savingsSms + otherSavings;
    $("#totalSavings").val(totalSavings);
    if(finishedLoading){
        calculateROI();
    }
}
function calculateROI(){
    //fraudAvoidedBy
    //totalCost
    var fraudAvoidedBy = parseFloat($("#fraudAvoidedBy").val());
    var totalSavings = parseFloat($("#totalSavings").val());
    var totalCost = parseFloat($("#totalCost").val());

    var roi = fraudAvoidedBy - totalCost + totalSavings;
    // console.log("fraudAvoidedBy", fraudAvoidedBy);
    // console.log("totalCost", totalCost);
    // console.log("totalSavings", totalSavings);
    // console.log("roi", roi);
    drawLines();
    $("#roi").val(roi);
}



function drawLines(){
    console.log(line_zoom);
}