$(document).ready(function(){

    /* Line Chart */
    var data1 = [[1, 10], [2, 20], [3, 12], [4, 28], [5, 15]];
    var data2 = [[1, 8], [2, 15], [3, 10], [4, 18], [5, 8]];

    var labels = ["Visits", "Page views", "Sales"];
    var colors = [
        '#43b968',
        '#3e70c9'
    ];

    $.plot($("#chart-1"), [{
        data : data1,
        label : labels[0],
        color : colors[0]
    }, {
        data : data2,
        label : labels[1],
        color : colors[1]
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
            show : false,
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

    /* Bar chart */
    var data1 = [];
    for (var i = 0; i <= 6; i += 1)
        data1.push([i, parseInt(Math.random() * 20)]);

    var data2 = [];
    for (var i = 0; i <= 6; i += 1)
        data2.push([i, parseInt(Math.random() * 20)]);

    var data = [{
        label : "Data One",
        data : data1,
        bars : {
            order : 1
        }
        
    }, {
        label : "Data Two",
        data : data2,
        bars : {
            order : 2
        }
    }];

    $.plot($("#chart-2"), data, {
        bars : {
            show : true,
            barWidth : 0.2,
            fill : 1
        },
        series : {
            stack: 0
        },
        grid : {
            color: "#aaa",
            hoverable : true,
            borderWidth : 0,
            labelMargin : 5,
            backgroundColor : "#fff",
        },
        legend : {
            show : false,
        },
        colors : ["#f59345", "#f44236"],
        tooltip : true, //activate tooltip
        tooltipOpts : {
            content : "%s : %y.0",
            shifts : {
                x : -30,
                y : -50
            }
        }
    });

    /* Donut chart */
    var data = [{
        label: "Series 0",
        data: 3,
        color: "#20b9ae",
        
    }, {
        label: "Series 1",
        data: 4,
        color: "#f44236",
    }, {
        label: "Series 2",
        data: 6,
        color:"#a567e2",
    }, {
        label: "Series 3",
        data: 2,
        color:"#f59345",
    }];

    $.plot($("#chart-3"), data, {
        series: {
            pie: {
                innerRadius: 0.5,
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        legend : {
            show : false,
        },
        color: null,
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

    /* Realtime chart */
    $(function() {

        // We use an inline data source in the example, usually data would
        // be fetched from a server

        var data = [],
            totalPoints = 300;

        function getRandomData() {
            if (data.length > 0)
                data = data.slice(1);

            // Do a random walk

            while (data.length < totalPoints) {
                var prev = data.length > 0 ? data[data.length - 1] : 50,
                    y = prev + Math.random() * 10 - 5;

                if (y < 5) {
                    y = 5;
                } else if (y > 95) {
                    y = 95;
                }

                data.push(y);
            }

            // Zip the generated y values with the x values

            var res = [];
            for (var i = 0; i < data.length; ++i) {
                res.push([i, data[i]])
            }

            return res;
        }

        // Set up the control widget

        var updateInterval = 30;

        var plot = $.plot("#realtime", [ getRandomData() ], {
            series: {
                shadowSize: 0   // Drawing is faster without shadows
            },
            yaxis: {
                min: 0,
                max: 100
            },
            xaxis: {
                min: 0,
                max: 300
            },
            colors: ["#43b968"],
            grid: {
                color: "#aaa",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#fff'
            },
            tooltip: true,
            tooltipOpts: {
                content: "Y: %y",
                defaultTheme: false
            }
        });

        function update() {
            plot.setData([getRandomData()]);

            // Since the axes don't change, we don't need to call plot.setupGrid()

            plot.draw();
            setTimeout(update, updateInterval);
        }

        update();

    });

});