// JavaScript Document
$(function () {
    $('#barra').highcharts({
		chart: {
            type: 'column',
              // Edit chart spacing
            spacingBottom: 0,
        },
        title: {
            text: ''
        },
		credits: {
            enabled: false
        },
        xAxis: {
			categories: ['DC', '60', '120', '180', '240', '300', '360', '420', '480', '540', '600', '660', '720'],
			title: {
                text: 'Frequencias (Hz)'
            },
			labels: {
                rotation: -45,
                style: {
                    fontSize: '8px',
                    fontFamily: 'Verdana, sans-serif'
                }
			}
        },
        yAxis: {
            title: {
                text: 'Módulo Normalizado (mA)'
            }
        },
        tooltip: {
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        }
    });
});
	
$(function () {
    $('#linha').highcharts({
        chart: {
            type: 'spline',
            // Edit chart spacing
            spacingBottom: 0,

        },
        legend: {
            enabled: false
        },
        title: {
            text: ''
        },
		credits: {
            enabled: false
        },
        xAxis: {
			title:{
				text: 'Tempo/100 (ms)'
			},
			labels: {
                rotation: -45,
                style: {
                    fontSize: '8px',
                    fontFamily: 'Verdana, sans-serif'
                }
        },
		 tickPositions: [0,104,201, 305, 403,501,605,703,800,904,1002,1100,1204,1302,1406,1503,1601]
		},
        yAxis: {
            title: {
                text: 'Corrente (mA)'
            },
        }
    });
});

$(function () {
    $('#fasebarra').highcharts({
		chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
		credits: {
            enabled: false
        },
        xAxis: {
			categories: ['DC', '60', '120', '180', '240', '300', '360', '420', '480', '540', '600', '660', '720'],
			labels:{
				 rotation: -45
			},
			title: {
                text: 'Frequencias (Hz)'
            }
        },
        yAxis: {
			categories: null,
            title: {
                text: 'Módulo Normalizado (mA)'
            }
        },
        tooltip: {
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        }
    });
});
	
$(function () {
    $('#faselinha').highcharts({
        chart: {
            type: 'spline',
            // Edit chart spacing
            spacingBottom: 0,

        },
        legend: {
            enabled: false
        },
        title: {
            text: ''
        },
        credits: {
            enabled: false
        },
        xAxis: {
            title:{
                text: 'Tempo/100 (ms)'
            },
            labels: {
                rotation: -45,
                style: {
                    fontSize: '8px',
                    fontFamily: 'Verdana, sans-serif'
                }
        },
         tickPositions: [0,104,201, 305, 403,501,605,703,800,904,1002,1100,1204,1302,1406,1503,1601]
        },
        yAxis: {
            title: {
                text: 'Corrente (mA)'
            },
        }
    });
});

$(function () {
    $('#fugabarra').highcharts({
		chart: {
			marginLeft: 62,
			spacingLeft: 0,
            type: 'column'
        },
        title: {
            text: ''
        },
		credits: {
            enabled: false
        },
        xAxis: {
			categories: ['DC', '60', '120', '180', '240', '300', '360', '420', '480', '540', '600', '660', '720'],
			labels:{
				 rotation: -45
			},
			title: {
                text: 'Frequencias (Hz)'
            }
        },
        yAxis: {
			categories: null,
            title: {
                text: 'Módulo Normalizado (mA)'
            }
        },
        tooltip: {
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        }
    });
});
	
$(function () {
    $('#fugalinha').highcharts({
        chart: {
            type: 'spline',
            // Edit chart spacing
            spacingBottom: 0,

        },
        legend: {
            enabled: false
        },
        title: {
            text: ''
        },
        credits: {
            enabled: false
        },
        xAxis: {
            title:{
                text: 'Tempo/100 (ms)'
            },
            labels: {
                rotation: -45,
                style: {
                    fontSize: '8px',
                    fontFamily: 'Verdana, sans-serif'
                }
        },
         tickPositions: [0,104,201, 305, 403,501,605,703,800,904,1002,1100,1204,1302,1406,1503,1601]
        },
        yAxis: {
            title: {
                text: 'Corrente (mA)'
            },
        }
    });
});