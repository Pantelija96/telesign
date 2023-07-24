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

    var line_zoom_element = document.getElementById('line_zoom');

    if (line_zoom_element) {

        var line_zoom = echarts.init(line_zoom_element, null, { renderer: 'svg' });


        line_zoom.setOption({

            // Define colors
            color: ["#d74e67", "#4fc686",  '#0092ff'],

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
                    end: 70
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
                    symbolSize: 8,
                    data: [5000,5000,5000,5000,5000,5000]
                },
                {
                    name: 'Savings',
                    type: 'line',
                    smooth: true,
                    symbol: 'circle',
                    symbolSize: 8,
                    data: [1000,3000,5000,7000,9000,11000]
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
});

