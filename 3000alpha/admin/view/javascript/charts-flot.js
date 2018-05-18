/* =================================================================
	Realtime chart
================================================================= */

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

/* =================================================================
	Line chart
================================================================= */

$(function() {

	var data1 = [[0, 5], [1, 10], [2, 14], [3, 20], [4, 16], [5, 30], [6, 25],[7, 22], [8, 20], [9, 28], [10, 24], [11, 36], [12, 18]];
	var data2 = [[0, 2], [1, 8], [2, 10], [3, 16], [4, 14], [5, 22], [6, 20],[7, 18], [8, 14], [9, 23], [10, 20], [11, 30], [12, 16]];
	var labels = ["Visits", "Page views"];
	var colors = ['#20b9ae','#f59345'];

	$.plot($("#line"), [{
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
						opacity : 0
					}, {
						opacity : 0
					}]
				}
			},
			points : {
				show : true
			},
			shadowSize : 0
		},

		grid : {
			color: "#aaa",
			hoverable : true,
			borderWidth : 0,
			backgroundColor : "#fff",
		},
		legend : {
			position : "ne",
			margin : [0, -24],
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

});

/* =================================================================
	Donut chart
================================================================= */

$(function() {

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

	$.plot($("#donut"), data, {
		series: {
			pie: {
				innerRadius: 0.7,
				show: true
			}
		},
		grid: {
			hoverable: true
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

});

/* =================================================================
	Pie chart
================================================================= */

$(function() {

	var data = [{
		label: "Series 0",
		data: 12,
		color: "#20b9ae",
		
	}, {
		label: "Series 1",
		data: 16,
		color: "#f44236",
	}, {
		label: "Series 3",
		data: 8,
		color:"#f59345",
	}];

	$.plot($("#pie"), data, {
		series: {
			pie: {
				show: true
			}
		},
		grid: {
			hoverable: true
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

});

/* =================================================================
	Stacked bar
================================================================= */

$(function() {

	var data1 = [];
	for (var i = 0; i <= 12; i += 1)
		data1.push([i, parseInt(Math.random() * 20)]);

	var data2 = [];
	for (var i = 0; i <= 12; i += 1)
		data2.push([i, parseInt(Math.random() * 20)]);

	var data3 = [];
	for (var i = 0; i <= 12; i += 1)
		data3.push([i, parseInt(Math.random() * 20)]);

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
	}, {
		label : "Data Three",
		data : data3,
		bars : {
			order : 3
		}
	}];

	$.plot($("#stacked-bar"), data, {
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
			position : "ne",
			margin : [0, -24],
			noColumns : 0,
			labelBoxBorderColor : null,
			labelFormatter : function(label, series) {
				// adding space to labes
				return '' + label + '&nbsp;&nbsp;';
			}
		},
		colors : ["#20b9ae", "#f44236", "#f59345"],
		tooltip : true, //activate tooltip
		tooltipOpts : {
			content : "%s : %y.0",
			shifts : {
				x : -30,
				y : -50
			}
		}
	});

});

