$(document).ready(function(){

    /* Sparkline Chart */
    $('#sparkline1').sparkline([0, 16, 30, 70, 30, 40, 67, 23, 44], {
        type: 'line',
        width: '60',
        height: '20',
        chartRangeMax: 50,
        lineColor: '#999',
        spotRadius: 2,
        fillColor: 'transparent',
        highlightLineColor: 'rgba(0,0,0,0.1)',
        highlightSpotColor: 'rgba(0,0,0,0.1)'
    });

    /* Main Chart */
    var data1 = [[1, 10], [2, 20], [3, 12], [4, 28], [5, 15], [6, 30], [7, 20], [8, 35], [9, 25], [10, 35]];
    var data2 = [[1, 8], [2, 15], [3, 10], [4, 18], [5, 8], [6, 25], [7, 15], [8, 28], [9, 17], [10, 30]];
    var data3 = [[1, 3], [2, 8], [3, 4], [4, 9], [5, 5], [6, 10], [7, 7], [8, 16], [9, 9], [10, 20]];

    var labels = ["Visits", "Page views", "Sales"];
    var colors = [
        '#20b9ae',
        tinycolor('#20b9ae').darken(4).toString(),
        tinycolor('#20b9ae').darken(8).toString()
    ];

    $.plot($("#main-chart"), [{
        data : data1,
        label : labels[0],
        color : colors[0]
    }, {
        data : data2,
        label : labels[1],
        color : colors[1]
    }, {
        data : data3,
        label : labels[2],
        color : colors[2]
    }], {
        series : {
            lines : {
                show : true,
                fill : true,
                lineWidth : 3,
                fillColor : {
                    colors : [{
                        opacity : 1
                    }, {
                        opacity : 1
                    }]
                }
            },
            points : {
                show : true,
                radius: 0
            },
            shadowSize : 0,
            curvedLines: {
                apply: true,
                active: true,
                monotonicFit: true
            }
        },
        grid : {
            labelMargin: 10,
            color: "#aaa",
            hoverable : true,
            borderWidth : 0,
            backgroundColor : "#fff",
        },
        legend : {
            position : "ne",
            margin : [0, -40],
            noColumns : 0,
            labelBoxBorderColor : null,
            labelFormatter : function(label, series) {
                // adding space to labes
                return '' + label + '&nbsp;&nbsp;';
            }
        },
        tooltip : true,
        tooltipOpts : {
            content : '%s: %y',
            shifts : {
                x : -60,
                y : 25
            },
            defaultTheme : false
        }
    });

    /* Morris Chart */
    Morris.Donut({
        element: 'donut',
        data: [{
            label: "Development",
            value: 34,

        }, {
            label: "SEO",
            value: 67
        }, {
            label: "Mobile apps",
            value: 45
        }],
        resize: true,
        colors:['#43b968', '#f59345', '#f44236']
    });

    /* Vector Map */
    $('#world').vectorMap({
        zoomOnScroll: false,
        map: 'world_mill',
        markers: [
            {latLng: [15.3, -61.38], name: 'Dominica'},
            {latLng: [48.8567, 2.3508], name: 'Paris'}, 
            {latLng: [47.14, 9.52], name: 'Liechtenstein'},
            {latLng: [35.6833, 139.6833], name: 'Tokyo'}, 
            {latLng: [40.7127, -74.0059], name: 'New York City'},
            {latLng: [35.88, 14.5], name: 'Malta'},
            {latLng: [22.2783, 114.1747], name: 'Hong Kong'},
            {latLng: [43.73, 7.41], name: 'Monaco'},
            {latLng: [-4.61, 55.45], name: 'Seychelles'},
            {latLng: [39.9167, 116.3833], name: 'Beijing'},
            {latLng: [1.3, 103.8], name: 'Singapore'},
            {latLng: [43.93, 12.46], name: 'San Marino'},
        ],
        normalizeFunction: 'polynomial',
        backgroundColor: 'transparent',
        regionsSelectable: true,
        markersSelectable: true,
        regionStyle: {
            initial: {
                fill: 'rgba(0,0,0,0.15)'
            },
            hover: {
                fill: 'rgba(0,0,0,0.15)',
            stroke: '#fff'
            },
        },
        markerStyle: {
            initial: {
                fill: '#43b968',
                stroke: '#fff'
            },
            hover: {
                fill: '#3e70c9',
                stroke: '#fff'
            }
        },
        series: {
            markers: [{
                attribute: 'fill',
                scale: ['#43b968','#a567e2', '#f44236'],
                values: [200, 300, 600, 1000, 150, 250, 450, 500, 800, 900, 750, 650]
            },{
                attribute: 'r',
                scale: [5, 15],
                values: [200, 300, 600, 1000, 150, 250, 450, 500, 800, 900, 750, 650]
            }]
        }
    });

});