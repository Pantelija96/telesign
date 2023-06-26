
const DatatableResponsive = function() {

    const _componentDatatableResponsive = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [ 3 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });

        // Basic responsive configuration
        $('.datatable-responsive').DataTable();
    };
    return {
        init: function() {
            _componentDatatableResponsive();
        }
    }
}();

var EchartsMapWorldScatter = function() {

    var _mapWorldScatterExample = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        var map_world_scatter_element = document.getElementById('worldMap');

        if (map_world_scatter_element) {

            // Initialize chart
            var map_world_scatter = echarts.init(map_world_scatter_element, null, { renderer: 'svg' });

            // Country coordinates
            var latlong = {};
            latlong.AD = {'latitude':42.5, 'longitude':1.5};
            latlong.AE = {'latitude':24, 'longitude':54};
            latlong.AF = {'latitude':33, 'longitude':65};
            latlong.AG = {'latitude':17.05, 'longitude':-61.8};
            latlong.AI = {'latitude':18.25, 'longitude':-63.1667};
            latlong.AL = {'latitude':41, 'longitude':20};
            latlong.AM = {'latitude':40, 'longitude':45};
            latlong.AN = {'latitude':12.25, 'longitude':-68.75};
            latlong.AO = {'latitude':-12.5, 'longitude':18.5};
            latlong.AP = {'latitude':35, 'longitude':105};
            latlong.AQ = {'latitude':-90, 'longitude':0};
            latlong.AR = {'latitude':-34, 'longitude':-64};
            latlong.AS = {'latitude':-14.3333, 'longitude':-170};
            latlong.AT = {'latitude':47.3333, 'longitude':13.3333};
            latlong.AU = {'latitude':-27, 'longitude':133};
            latlong.AW = {'latitude':12.5, 'longitude':-69.9667};
            latlong.AZ = {'latitude':40.5, 'longitude':47.5};
            latlong.BA = {'latitude':44, 'longitude':18};
            latlong.BB = {'latitude':13.1667, 'longitude':-59.5333};
            latlong.BD = {'latitude':24, 'longitude':90};
            latlong.BE = {'latitude':50.8333, 'longitude':4};
            latlong.BF = {'latitude':13, 'longitude':-2};
            latlong.BG = {'latitude':43, 'longitude':25};
            latlong.BH = {'latitude':26, 'longitude':50.55};
            latlong.BI = {'latitude':-3.5, 'longitude':30};
            latlong.BJ = {'latitude':9.5, 'longitude':2.25};
            latlong.BM = {'latitude':32.3333, 'longitude':-64.75};
            latlong.BN = {'latitude':4.5, 'longitude':114.6667};
            latlong.BO = {'latitude':-17, 'longitude':-65};
            latlong.BR = {'latitude':-10, 'longitude':-55};
            latlong.BS = {'latitude':24.25, 'longitude':-76};
            latlong.BT = {'latitude':27.5, 'longitude':90.5};
            latlong.BV = {'latitude':-54.4333, 'longitude':3.4};
            latlong.BW = {'latitude':-22, 'longitude':24};
            latlong.BY = {'latitude':53, 'longitude':28};
            latlong.BZ = {'latitude':17.25, 'longitude':-88.75};
            latlong.CA = {'latitude':54, 'longitude':-100};
            latlong.CC = {'latitude':-12.5, 'longitude':96.8333};
            latlong.CD = {'latitude':0, 'longitude':25};
            latlong.CF = {'latitude':7, 'longitude':21};
            latlong.CG = {'latitude':-1, 'longitude':15};
            latlong.CH = {'latitude':47, 'longitude':8};
            latlong.CI = {'latitude':8, 'longitude':-5};
            latlong.CK = {'latitude':-21.2333, 'longitude':-159.7667};
            latlong.CL = {'latitude':-30, 'longitude':-71};
            latlong.CM = {'latitude':6, 'longitude':12};
            latlong.CN = {'latitude':35, 'longitude':105};
            latlong.CO = {'latitude':4, 'longitude':-72};
            latlong.CR = {'latitude':10, 'longitude':-84};
            latlong.CU = {'latitude':21.5, 'longitude':-80};
            latlong.CV = {'latitude':16, 'longitude':-24};
            latlong.CX = {'latitude':-10.5, 'longitude':105.6667};
            latlong.CY = {'latitude':35, 'longitude':33};
            latlong.CZ = {'latitude':49.75, 'longitude':15.5};
            latlong.DE = {'latitude':51, 'longitude':9};
            latlong.DJ = {'latitude':11.5, 'longitude':43};
            latlong.DK = {'latitude':56, 'longitude':10};
            latlong.DM = {'latitude':15.4167, 'longitude':-61.3333};
            latlong.DO = {'latitude':19, 'longitude':-70.6667};
            latlong.DZ = {'latitude':28, 'longitude':3};
            latlong.EC = {'latitude':-2, 'longitude':-77.5};
            latlong.EE = {'latitude':59, 'longitude':26};
            latlong.EG = {'latitude':27, 'longitude':30};
            latlong.EH = {'latitude':24.5, 'longitude':-13};
            latlong.ER = {'latitude':15, 'longitude':39};
            latlong.ES = {'latitude':40, 'longitude':-4};
            latlong.ET = {'latitude':8, 'longitude':38};
            latlong.EU = {'latitude':47, 'longitude':8};
            latlong.FI = {'latitude':62, 'longitude':26};
            latlong.FJ = {'latitude':-18, 'longitude':175};
            latlong.FK = {'latitude':-51.75, 'longitude':-59};
            latlong.FM = {'latitude':6.9167, 'longitude':158.25};
            latlong.FO = {'latitude':62, 'longitude':-7};
            latlong.FR = {'latitude':46, 'longitude':2};
            latlong.GA = {'latitude':-1, 'longitude':11.75};
            latlong.GB = {'latitude':54, 'longitude':-2};
            latlong.GD = {'latitude':12.1167, 'longitude':-61.6667};
            latlong.GE = {'latitude':42, 'longitude':43.5};
            latlong.GF = {'latitude':4, 'longitude':-53};
            latlong.GH = {'latitude':8, 'longitude':-2};
            latlong.GI = {'latitude':36.1833, 'longitude':-5.3667};
            latlong.GL = {'latitude':72, 'longitude':-40};
            latlong.GM = {'latitude':13.4667, 'longitude':-16.5667};
            latlong.GN = {'latitude':11, 'longitude':-10};
            latlong.GP = {'latitude':16.25, 'longitude':-61.5833};
            latlong.GQ = {'latitude':2, 'longitude':10};
            latlong.GR = {'latitude':39, 'longitude':22};
            latlong.GS = {'latitude':-54.5, 'longitude':-37};
            latlong.GT = {'latitude':15.5, 'longitude':-90.25};
            latlong.GU = {'latitude':13.4667, 'longitude':144.7833};
            latlong.GW = {'latitude':12, 'longitude':-15};
            latlong.GY = {'latitude':5, 'longitude':-59};
            latlong.HK = {'latitude':22.25, 'longitude':114.1667};
            latlong.HM = {'latitude':-53.1, 'longitude':72.5167};
            latlong.HN = {'latitude':15, 'longitude':-86.5};
            latlong.HR = {'latitude':45.1667, 'longitude':15.5};
            latlong.HT = {'latitude':19, 'longitude':-72.4167};
            latlong.HU = {'latitude':47, 'longitude':20};
            latlong.ID = {'latitude':-5, 'longitude':120};
            latlong.IE = {'latitude':53, 'longitude':-8};
            latlong.IL = {'latitude':31.5, 'longitude':34.75};
            latlong.IN = {'latitude':20, 'longitude':77};
            latlong.IO = {'latitude':-6, 'longitude':71.5};
            latlong.IQ = {'latitude':33, 'longitude':44};
            latlong.IR = {'latitude':32, 'longitude':53};
            latlong.IS = {'latitude':65, 'longitude':-18};
            latlong.IT = {'latitude':42.8333, 'longitude':12.8333};
            latlong.JM = {'latitude':18.25, 'longitude':-77.5};
            latlong.JO = {'latitude':31, 'longitude':36};
            latlong.JP = {'latitude':36, 'longitude':138};
            latlong.KE = {'latitude':1, 'longitude':38};
            latlong.KG = {'latitude':41, 'longitude':75};
            latlong.KH = {'latitude':13, 'longitude':105};
            latlong.KI = {'latitude':1.4167, 'longitude':173};
            latlong.KM = {'latitude':-12.1667, 'longitude':44.25};
            latlong.KN = {'latitude':17.3333, 'longitude':-62.75};
            latlong.KP = {'latitude':40, 'longitude':127};
            latlong.KR = {'latitude':37, 'longitude':127.5};
            latlong.KW = {'latitude':29.3375, 'longitude':47.6581};
            latlong.KY = {'latitude':19.5, 'longitude':-80.5};
            latlong.KZ = {'latitude':48, 'longitude':68};
            latlong.LA = {'latitude':18, 'longitude':105};
            latlong.LB = {'latitude':33.8333, 'longitude':35.8333};
            latlong.LC = {'latitude':13.8833, 'longitude':-61.1333};
            latlong.LI = {'latitude':47.1667, 'longitude':9.5333};
            latlong.LK = {'latitude':7, 'longitude':81};
            latlong.LR = {'latitude':6.5, 'longitude':-9.5};
            latlong.LS = {'latitude':-29.5, 'longitude':28.5};
            latlong.LT = {'latitude':55, 'longitude':24};
            latlong.LU = {'latitude':49.75, 'longitude':6};
            latlong.LV = {'latitude':57, 'longitude':25};
            latlong.LY = {'latitude':25, 'longitude':17};
            latlong.MA = {'latitude':32, 'longitude':-5};
            latlong.MC = {'latitude':43.7333, 'longitude':7.4};
            latlong.MD = {'latitude':47, 'longitude':29};
            latlong.ME = {'latitude':42.5, 'longitude':19.4};
            latlong.MG = {'latitude':-20, 'longitude':47};
            latlong.MH = {'latitude':9, 'longitude':168};
            latlong.MK = {'latitude':41.8333, 'longitude':22};
            latlong.ML = {'latitude':17, 'longitude':-4};
            latlong.MM = {'latitude':22, 'longitude':98};
            latlong.MN = {'latitude':46, 'longitude':105};
            latlong.MO = {'latitude':22.1667, 'longitude':113.55};
            latlong.MP = {'latitude':15.2, 'longitude':145.75};
            latlong.MQ = {'latitude':14.6667, 'longitude':-61};
            latlong.MR = {'latitude':20, 'longitude':-12};
            latlong.MS = {'latitude':16.75, 'longitude':-62.2};
            latlong.MT = {'latitude':35.8333, 'longitude':14.5833};
            latlong.MU = {'latitude':-20.2833, 'longitude':57.55};
            latlong.MV = {'latitude':3.25, 'longitude':73};
            latlong.MW = {'latitude':-13.5, 'longitude':34};
            latlong.MX = {'latitude':23, 'longitude':-102};
            latlong.MY = {'latitude':2.5, 'longitude':112.5};
            latlong.MZ = {'latitude':-18.25, 'longitude':35};
            latlong.NA = {'latitude':-22, 'longitude':17};
            latlong.NC = {'latitude':-21.5, 'longitude':165.5};
            latlong.NE = {'latitude':16, 'longitude':8};
            latlong.NF = {'latitude':-29.0333, 'longitude':167.95};
            latlong.NG = {'latitude':10, 'longitude':8};
            latlong.NI = {'latitude':13, 'longitude':-85};
            latlong.NL = {'latitude':52.5, 'longitude':5.75};
            latlong.NO = {'latitude':62, 'longitude':10};
            latlong.NP = {'latitude':28, 'longitude':84};
            latlong.NR = {'latitude':-0.5333, 'longitude':166.9167};
            latlong.NU = {'latitude':-19.0333, 'longitude':-169.8667};
            latlong.NZ = {'latitude':-41, 'longitude':174};
            latlong.OM = {'latitude':21, 'longitude':57};
            latlong.PA = {'latitude':9, 'longitude':-80};
            latlong.PE = {'latitude':-10, 'longitude':-76};
            latlong.PF = {'latitude':-15, 'longitude':-140};
            latlong.PG = {'latitude':-6, 'longitude':147};
            latlong.PH = {'latitude':13, 'longitude':122};
            latlong.PK = {'latitude':30, 'longitude':70};
            latlong.PL = {'latitude':52, 'longitude':20};
            latlong.PM = {'latitude':46.8333, 'longitude':-56.3333};
            latlong.PR = {'latitude':18.25, 'longitude':-66.5};
            latlong.PS = {'latitude':32, 'longitude':35.25};
            latlong.PT = {'latitude':39.5, 'longitude':-8};
            latlong.PW = {'latitude':7.5, 'longitude':134.5};
            latlong.PY = {'latitude':-23, 'longitude':-58};
            latlong.QA = {'latitude':25.5, 'longitude':51.25};
            latlong.RE = {'latitude':-21.1, 'longitude':55.6};
            latlong.RO = {'latitude':46, 'longitude':25};
            latlong.RS = {'latitude':44, 'longitude':21};
            latlong.RU = {'latitude':60, 'longitude':100};
            latlong.RW = {'latitude':-2, 'longitude':30};
            latlong.SA = {'latitude':25, 'longitude':45};
            latlong.SB = {'latitude':-8, 'longitude':159};
            latlong.SC = {'latitude':-4.5833, 'longitude':55.6667};
            latlong.SD = {'latitude':15, 'longitude':30};
            latlong.SE = {'latitude':62, 'longitude':15};
            latlong.SG = {'latitude':1.3667, 'longitude':103.8};
            latlong.SH = {'latitude':-15.9333, 'longitude':-5.7};
            latlong.SI = {'latitude':46, 'longitude':15};
            latlong.SJ = {'latitude':78, 'longitude':20};
            latlong.SK = {'latitude':48.6667, 'longitude':19.5};
            latlong.SL = {'latitude':8.5, 'longitude':-11.5};
            latlong.SM = {'latitude':43.7667, 'longitude':12.4167};
            latlong.SN = {'latitude':14, 'longitude':-14};
            latlong.SO = {'latitude':10, 'longitude':49};
            latlong.SR = {'latitude':4, 'longitude':-56};
            latlong.ST = {'latitude':1, 'longitude':7};
            latlong.SV = {'latitude':13.8333, 'longitude':-88.9167};
            latlong.SY = {'latitude':35, 'longitude':38};
            latlong.SZ = {'latitude':-26.5, 'longitude':31.5};
            latlong.TC = {'latitude':21.75, 'longitude':-71.5833};
            latlong.TD = {'latitude':15, 'longitude':19};
            latlong.TF = {'latitude':-43, 'longitude':67};
            latlong.TG = {'latitude':8, 'longitude':1.1667};
            latlong.TH = {'latitude':15, 'longitude':100};
            latlong.TJ = {'latitude':39, 'longitude':71};
            latlong.TK = {'latitude':-9, 'longitude':-172};
            latlong.TM = {'latitude':40, 'longitude':60};
            latlong.TN = {'latitude':34, 'longitude':9};
            latlong.TO = {'latitude':-20, 'longitude':-175};
            latlong.TR = {'latitude':39, 'longitude':35};
            latlong.TT = {'latitude':11, 'longitude':-61};
            latlong.TV = {'latitude':-8, 'longitude':178};
            latlong.TW = {'latitude':23.5, 'longitude':121};
            latlong.TZ = {'latitude':-6, 'longitude':35};
            latlong.UA = {'latitude':49, 'longitude':32};
            latlong.UG = {'latitude':1, 'longitude':32};
            latlong.UM = {'latitude':19.2833, 'longitude':166.6};
            latlong.US = {'latitude':38, 'longitude':-97};
            latlong.UY = {'latitude':-33, 'longitude':-56};
            latlong.UZ = {'latitude':41, 'longitude':64};
            latlong.VA = {'latitude':41.9, 'longitude':12.45};
            latlong.VC = {'latitude':13.25, 'longitude':-61.2};
            latlong.VE = {'latitude':8, 'longitude':-66};
            latlong.VG = {'latitude':18.5, 'longitude':-64.5};
            latlong.VI = {'latitude':18.3333, 'longitude':-64.8333};
            latlong.VN = {'latitude':16, 'longitude':106};
            latlong.VU = {'latitude':-16, 'longitude':167};
            latlong.WF = {'latitude':-13.3, 'longitude':-176.2};
            latlong.WS = {'latitude':-13.5833, 'longitude':-172.3333};
            latlong.YE = {'latitude':15, 'longitude':48};
            latlong.YT = {'latitude':-12.8333, 'longitude':45.1667};
            latlong.ZA = {'latitude':-29, 'longitude':24};
            latlong.ZM = {'latitude':-15, 'longitude':30};
            latlong.ZW = {'latitude':-20, 'longitude':30};

            // Dummy data
            var mapData = [
                {'code':'CN' , 'name':'China', 'value':1456},
                {'code':'RU' , 'name':'Russia', 'value':2231},
                {'code':'US' , 'name':'United States', 'value':6322},
            ];

            // Configure heatmap
            var max = -Infinity;
            var min = Infinity;
            mapData.forEach(function (itemOpt) {
                if (itemOpt.value > max) {
                    max = itemOpt.value;
                }
                if (itemOpt.value < min) {
                    min = itemOpt.value;
                }
            });

            // Colors
            var mapBackgroundColor = 'var(--map-bg)',
                mapPlaceholderColor = 'var(--map-placeholder-color)',
                mapHoverColor = 'var(--map-hover-color)',
                mapBorderColor = 'var(--map-border-color)',
                scatterColor = ['#ffd648'];

            // Options
            map_world_scatter.setOption({

                // Map background color
                backgroundColor: mapBackgroundColor,

                // Global text style
                textStyle: {
                    fontFamily: 'var(--body-font-family)',
                    color: 'var(--body-color)',
                    fontSize: 14,
                    lineHeight: 22,
                    textBorderColor: 'transparent'
                },

                // Tooltip
                tooltip: {
                    trigger: 'item',
                    formatter : function (params) {
                        return 'Numbers: ' + params.value[2];
                    },
                    className: 'shadow-sm rounded',
                    backgroundColor: 'var(--white)',
                    borderColor: 'rgba(var(--black-rgb), 0.5)',
                    padding: [10, 15],
                    textStyle: {
                        color: '#000'
                    },
                    axisPointer: {
                        type: 'shadow',
                        shadowStyle: {
                            color: 'rgba(var(--body-color-rgb), 0.025)'
                        }
                    }
                },

                // Visual map
                visualMap: {
                    show: false,
                    min: 0,
                    max: max,
                    inRange: {
                        symbolSize: [6, 60],
                        color: scatterColor
                    }
                },

                // Map config
                geo: {
                    type: 'map',
                    map: 'world',
                    roam: true,
                    zoom: 1.25,
                    aspectScale: 0.85,
                    scaleLimit: {
                        min: 1.25,
                        max: 4
                    },
                    label: {
                        emphasis: {
                            show: false
                        }
                    },
                    itemStyle: {
                        normal: {
                            areaColor: mapPlaceholderColor,
                            borderColor: mapBorderColor,
                            borderWidth: 1
                        },
                        emphasis: {
                            areaColor: mapHoverColor
                        }
                    }
                },

                // Add series
                series: [
                    {
                        type: 'scatter',
                        coordinateSystem: 'geo',
                        data: mapData.map(function (itemOpt) {
                            return {
                                name: itemOpt.name,
                                value: [
                                    latlong[itemOpt.code].longitude,
                                    latlong[itemOpt.code].latitude,
                                    itemOpt.value
                                ],
                                label: {
                                    emphasis: {
                                        show: false
                                    }
                                },
                                itemStyle: {
                                    normal: {
                                        color: itemOpt.color,
                                        opacity: 0.9
                                    }
                                }
                            };
                        })
                    }
                ]
            });

            // map_world_scatter.on('click', function(params) {
            //     alert(params.name);
            //     if(params.name === "Russia"){
                    
            //     }
            // });
        }

        var triggerChartResize = function() {
            map_world_scatter_element && map_world_scatter.resize();
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
    };

    return {
        init: function() {
            _mapWorldScatterExample();
        }
    }
}();

var EchartsBarsStackedLight = function() {

    var _barsStackedLightExample = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        var elements = [
            document.getElementById('country2Map'),
            document.getElementById('country1Map'),
            document.getElementById('country3Map')
        ];

        //var bars_stacked_element = document.getElementById('country1Map');

        for(var i=0; i<elements.length; i++){
            if(elements[i]){
                var bars_stacked = echarts.init(elements[i], null, { renderer: 'svg' });
                bars_stacked.setOption({

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
                        left: 0,
                        right: 30,
                        top: 35,
                        bottom: 0,
                        containLabel: true
                    },

                    // Add legend
                    legend: {
                        data: ['Allow', 'Flag', 'Block'],
                        itemHeight: 8,
                        itemGap: 30,
                        textStyle: {
                            color: 'var(--body-color)',
                            padding: [0, 5]
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
                        },
                        axisPointer: {
                            type: 'shadow',
                            shadowStyle: {
                                color: 'rgba(var(--body-color-rgb), 0.025)'
                            }
                        }
                    },

                    // Horizontal axis
                    xAxis: [{
                        type: 'value',
                        axisLabel: {
                            color: 'rgba(var(--body-color-rgb), .65)'
                        },
                        axisLine: {
                            show: true,
                            lineStyle: {
                                color: 'var(--gray-500)'
                            }
                        },
                        splitLine: {
                            show: true,
                            lineStyle: {
                                color: 'var(--gray-300)',
                                type: 'dashed'
                            }
                        }
                    }],

                    // Vertical axis
                    yAxis: [{
                        type: 'category',
                        data: ['Mobile phone', 'Invalid', 'Restricted', 'Non-Fixed VOIP', 'Other'],
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
                        splitArea: {
                            show: true,
                            areaStyle: {
                                color: ['rgba(var(--white-rgb), .01)', 'rgba(var(--black-rgb), .01)']
                            }
                        }
                    }],
                });
                if(i===0){
                    bars_stacked.setOption({
                        // Add series
                        series: [
                            {
                                name: 'Allow',
                                type: 'bar',
                                stack: 'Total',
                                barWidth: 36,
                                itemStyle: {
                                    normal: {
                                        color: '#6ec952',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[320, 302, 301, 334, 390]
                            },
                            {
                                name: 'Flag',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#e7e146',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[220, 182, 191, 234]
                            },
                            {
                                name: 'Block',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#da3533',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[120, 132, 101, 134, 120]
                            }
                        ]
                    })
                }
                if(i===1){
                    bars_stacked.setOption({
                        // Add series
                        series: [
                            {
                                name: 'Allow',
                                type: 'bar',
                                stack: 'Total',
                                barWidth: 36,
                                itemStyle: {
                                    normal: {
                                        color: '#6ec952',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[52, 33, 55, 52, 38]
                            },
                            {
                                name: 'Flag',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#e7e146',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[77, 44, 23, 72]
                            },
                            {
                                name: 'Block',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#da3533',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[85, 52, 66, 123, 33]
                            }
                        ]
                    })
                }
                if(i===2){
                    bars_stacked.setOption({
                        // Add series
                        series: [
                            {
                                name: 'Allow',
                                type: 'bar',
                                stack: 'Total',
                                barWidth: 36,
                                itemStyle: {
                                    normal: {
                                        color: '#6ec952',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[123, 43, 99, 93, 86]
                            },
                            {
                                name: 'Flag',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#e7e146',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[66, 84, 85, 211,44]
                            },
                            {
                                name: 'Block',
                                type: 'bar',
                                stack: 'Total',
                                itemStyle: {
                                    normal: {
                                        color: '#da3533',
                                        label: {
                                            show: true,
                                            position: 'insideRight',
                                            padding: [0, 10],
                                            fontSize: 12,
                                            fontWeight: 500
                                        }
                                    }
                                },
                                data:[100, 52, 123, 63, 70]
                            }
                        ]
                    })
                }
            }
        }

        // if (bars_stacked_element) {
        //
        //     // Initialize chart
        //     var bars_stacked = echarts.init(bars_stacked_element, null, { renderer: 'svg' });
        //
        //     bars_stacked.setOption({
        //
        //         // Global text styles
        //         textStyle: {
        //             fontFamily: 'var(--body-font-family)',
        //             color: 'var(--body-color)',
        //             fontSize: 14,
        //             lineHeight: 22,
        //             textBorderColor: 'transparent'
        //         },
        //
        //         // Chart animation duration
        //         animationDuration: 750,
        //
        //         // Setup grid
        //         grid: {
        //             left: 0,
        //             right: 30,
        //             top: 35,
        //             bottom: 0,
        //             containLabel: true
        //         },
        //
        //         // Add legend
        //         legend: {
        //             data: ['Allow', 'Flag', 'Block'],
        //             itemHeight: 8,
        //             itemGap: 30,
        //             textStyle: {
        //                 color: 'var(--body-color)',
        //                 padding: [0, 5]
        //             }
        //         },
        //
        //         // Add tooltip
        //         tooltip: {
        //             trigger: 'axis',
        //             className: 'shadow-sm rounded',
        //             backgroundColor: 'var(--white)',
        //             borderColor: 'var(--gray-400)',
        //             padding: 15,
        //             textStyle: {
        //                 color: '#000'
        //             },
        //             axisPointer: {
        //                 type: 'shadow',
        //                 shadowStyle: {
        //                     color: 'rgba(var(--body-color-rgb), 0.025)'
        //                 }
        //             }
        //         },
        //
        //         // Horizontal axis
        //         xAxis: [{
        //             type: 'value',
        //             axisLabel: {
        //                 color: 'rgba(var(--body-color-rgb), .65)'
        //             },
        //             axisLine: {
        //                 show: true,
        //                 lineStyle: {
        //                     color: 'var(--gray-500)'
        //                 }
        //             },
        //             splitLine: {
        //                 show: true,
        //                 lineStyle: {
        //                     color: 'var(--gray-300)',
        //                     type: 'dashed'
        //                 }
        //             }
        //         }],
        //
        //         // Vertical axis
        //         yAxis: [{
        //             type: 'category',
        //             data: ['Mobile phone', 'Invalid', 'Restricted', 'Non-Fixed VOIP', 'Other'],
        //             axisLabel: {
        //                 color: 'rgba(var(--body-color-rgb), .65)'
        //             },
        //             axisLine: {
        //                 lineStyle: {
        //                     color: 'var(--gray-500)'
        //                 }
        //             },
        //             splitLine: {
        //                 show: true,
        //                 lineStyle: {
        //                     color: 'var(--gray-300)'
        //                 }
        //             },
        //             splitArea: {
        //                 show: true,
        //                 areaStyle: {
        //                     color: ['rgba(var(--white-rgb), .01)', 'rgba(var(--black-rgb), .01)']
        //                 }
        //             }
        //         }],
        //
        //         // Add series
        //         series: [
        //             {
        //                 name: 'Allow',
        //                 type: 'bar',
        //                 stack: 'Total',
        //                 barWidth: 36,
        //                 itemStyle: {
        //                     normal: {
        //                         color: '#6ec952',
        //                         label: {
        //                             show: true,
        //                             position: 'insideRight',
        //                             padding: [0, 10],
        //                             fontSize: 12,
        //                             fontWeight: 500
        //                         }
        //                     }
        //                 },
        //                 data:[320, 302, 301, 334, 390]
        //             },
        //             {
        //                 name: 'Block',
        //                 type: 'bar',
        //                 stack: 'Total',
        //                 itemStyle: {
        //                     normal: {
        //                         color: '#da3533',
        //                         label: {
        //                             show: true,
        //                             position: 'insideRight',
        //                             padding: [0, 10],
        //                             fontSize: 12,
        //                             fontWeight: 500
        //                         }
        //                     }
        //                 },
        //                 data:[120, 132, 101, 134, 120]
        //             },
        //             {
        //                 name: 'Flag',
        //                 type: 'bar',
        //                 stack: 'Total',
        //                 itemStyle: {
        //                     normal: {
        //                         color: '#e7e146',
        //                         label: {
        //                             show: true,
        //                             position: 'insideRight',
        //                             padding: [0, 10],
        //                             fontSize: 12,
        //                             fontWeight: 500
        //                         }
        //                     }
        //                 },
        //                 data:[220, 182, 191, 234]
        //             }
        //         ]
        //     });
        // }


        var triggerChartResize = function() {
            elements && bars_stacked.resize();
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
    };

    return {
        init: function() {
            _barsStackedLightExample();
        }
    }
}();

var EchartsPieBasicLight = function() {

    var _scatterPieBasicLightExample = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        var pie_basic_element = document.getElementById('pie_basic');

        if (pie_basic_element) {

            var pie_basic = echarts.init(pie_basic_element, null, { renderer: 'svg' });

            pie_basic.setOption({

                // Colors
                color: [
                    '#3fb922','#b2b03f','#a21b1b','#ffb980','#d87a80',
                    '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
                    '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                    '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'var(--body-font-family)',
                    color: 'var(--body-color)',
                    fontSize: 14,
                    lineHeight: 22,
                    textBorderColor: 'transparent'
                },

                // Add title
                // title: {
                //     text: 'Browser popularity',
                //     subtext: 'Open source information',
                //     left: 'center',
                //     textStyle: {
                //         fontSize: 18,
                //         fontWeight: 500,
                //         color: 'var(--body-color)'
                //     },
                //     subtextStyle: {
                //         fontSize: 12,
                //         color: 'rgba(var(--body-color-rgb), 0.5)'
                //     }
                // },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    className: 'shadow-sm rounded',
                    backgroundColor: 'var(--white)',
                    borderColor: 'var(--gray-400)',
                    padding: 15,
                    textStyle: {
                        color: '#000'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    top: 'center',
                    left: 0,
                    data: ['Allow', 'Flag', 'Block'],
                    itemHeight: 8,
                    itemWidth: 8,
                    textStyle: {
                        color: 'var(--body-color)'
                    },
                    itemStyle: {
                        borderColor: 'transparent'
                    }
                },

                // Add series
                series: [{
                    name: 'Numbers to',
                    type: 'pie',
                    radius: '70%',
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        borderColor: 'var(--card-bg)'
                    },
                    label: {
                        color: 'var(--body-color)'
                    },
                    data: [
                        {value: 335, name: 'Allow 38.11%'},
                        {value: 310, name: 'Flag 35.27%'},
                        {value: 234, name: 'Block 26.62%'},
                    ]
                }]
            });
        }


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            pie_basic_element && pie_basic.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelectorAll('.sidebar-control');
        if (sidebarToggle) {
            sidebarToggle.forEach(function(togglers) {
                togglers.addEventListener('click', triggerChartResize);
            });
        }

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _scatterPieBasicLightExample();
        }
    }
}();

var EchartsPieDonutLight = function() {

    var _scatterPieDonutLightExample = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        var pie_donut_element = document.getElementById('pie_donut');


        if (pie_donut_element) {

            var pie_donut = echarts.init(pie_donut_element, null, { renderer: 'svg' });

            pie_donut.setOption({

                color: [
                    '#56a34c','#88d680','#f6cb75','#ee9328','#d87a80',
                    '#e15a57','#c80200','#97b552','#95706d','#dc69aa',
                    '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
                    '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'var(--body-font-family)',
                    color: 'var(--body-color)',
                    fontSize: 14,
                    lineHeight: 22,
                    textBorderColor: 'transparent'
                },

                // Add title
                // title: {
                //     text: 'Browser popularity',
                //     subtext: 'Open source information',
                //     left: 'center',
                //     textStyle: {
                //         fontSize: 18,
                //         fontWeight: 500,
                //         color: 'var(--body-color)'
                //     },
                //     subtextStyle: {
                //         fontSize: 12,
                //         color: 'rgba(var(--body-color-rgb), 0.5)'
                //     }
                // },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    className: 'shadow-sm rounded',
                    backgroundColor: 'var(--white)',
                    borderColor: 'var(--gray-400)',
                    padding: 15,
                    textStyle: {
                        color: '#000'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    top: 'center',
                    left: 0,
                    data: ['Very-low', 'Low', 'Medium-low', 'Medium', 'High', 'Very-high'],
                    itemHeight: 8,
                    itemWidth: 8,
                    textStyle: {
                        color: 'var(--body-color)'
                    },
                    itemStyle: {
                        borderColor: 'transparent'
                    }
                },

                // Add series
                series: [{
                    name: 'Risk level',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        borderColor: 'var(--card-bg)'
                    },
                    label: {
                        color: 'var(--body-color)'
                    },
                    data: [
                        {value: 335, name: 'Very-low'},
                        {value: 310, name: 'Low'},
                        {value: 234, name: 'Medium-low'},
                        {value: 135, name: 'Medium'},
                        {value: 1548, name: 'High'},
                        {value: 1548, name: 'Very-high'}
                    ]
                }]
            });
        }


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            pie_donut_element && pie_donut.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelectorAll('.sidebar-control');
        if (sidebarToggle) {
            sidebarToggle.forEach(function(togglers) {
                togglers.addEventListener('click', triggerChartResize);
            });
        }

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _scatterPieDonutLightExample();
        }
    }
}();

var EchartsLinesZoomLight = function() {

    var _linesZoomLightExample = function() {
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


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            line_zoom_element && line_zoom.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelectorAll('.sidebar-control');
        if (sidebarToggle) {
            sidebarToggle.forEach(function(togglers) {
                togglers.addEventListener('click', triggerChartResize);
            });
        }

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _linesZoomLightExample();
        }
    }
}();

const DatatableAdvanced = function() {


    //
    // Setup module components
    //

    // Basic Datatable examples
    const _componentDatatableAdvanced = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend( $.fn.dataTable.defaults, {
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [ 5 ]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
            language: {
                search: '<span class="me-3">Filter:</span> <div class="form-control-feedback form-control-feedback-end flex-fill">_INPUT_<div class="form-control-feedback-icon"><i class="ph-magnifying-glass opacity-50"></i></div></div>',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span class="me-3">Show:</span> _MENU_',
                paginate: { 'first': 'First', 'last': 'Last', 'next': document.dir == "rtl" ? '&larr;' : '&rarr;', 'previous': document.dir == "rtl" ? '&rarr;' : '&larr;' }
            }
        });


        // Datatable 'length' options
        $('.datatable-show-all').DataTable({
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });

        // DOM positioning
        $('.datatable-dom-position').DataTable({
            dom: '<"datatable-header length-left"lp><"datatable-scroll"t><"datatable-footer info-right"fi>',
        });

        // Highlighting rows and columns on mouseover
        const lastIdx = null;
        const table = $('.datatable-highlight').DataTable();

        $('.datatable-highlight tbody').on('mouseover', 'td', function() {
            const colIdx = table.cell(this).index().column;

            if (colIdx !== lastIdx) {
                $(table.cells().nodes()).removeClass('active');
                $(table.column(colIdx).nodes()).addClass('active');
            }
        }).on('mouseleave', function() {
            $(table.cells().nodes()).removeClass('active');
        });

        // Columns rendering
        $('.datatable-columns').dataTable({
            columnDefs: [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    render: function (data, type, row) {
                        return data +' ('+ row[3]+')';
                    },
                    targets: 0
                },
                { visible: false, targets: [ 3 ] }
            ]
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableAdvanced();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    DatatableResponsive.init();
    EchartsMapWorldScatter.init();
    EchartsBarsStackedLight.init();
    EchartsPieBasicLight.init();
    EchartsPieDonutLight.init();
    EchartsLinesZoomLight.init();
    DatatableAdvanced.init();

    $("#addToTable").click(function(){

    });
});
