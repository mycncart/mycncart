//[Dashboard Javascript]

//Project:	Fab Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  
	

// table
	$('#invoice-list').DataTable({
	  'paging'      : true,
	  'lengthChange': false,
	  'searching'   : false,
	  'ordering'    : true,
	  'info'        : true,
	  'autoWidth'   : true,
	});

	
//sparkline charts
$(document).ready(function() {
   var sparklineLogin = function() { 
       
  
        $("#sparkline8").sparkline([2,4,4,6,8,5,6,4,8,6,6,2 ], {
            type: 'line',
            width: '100%',
            height: '110',
            lineColor: '#fb9678',
            fillColor: '#fb9678',
            maxSpotColor: '#fb9678',
            highlightLineColor: 'rgba(0, 0, 0, 0.2)',
            highlightSpotColor: '#fb9678'
        });
        
   }
    var sparkResize;
 
        $(window).resize(function(e) {
            clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineLogin, 500);
        });
        sparklineLogin();

});
	



// AREA CHART
    var area = new Morris.Area({
      element: 'chart_1',
      resize: true,
      data: [
        { y: '2018-01', a: 500,  b: 400 },
		{ y: '2018-02', a: 200,  b: 300 },
		{ y: '2018-03', a: 800,  b: 700 },
		{ y: '2018-04', a: 100,  b: 500 },
		{ y: '2018-05', a: 500,  b: 200 },
		{ y: '2018-06', a: 100,  b: 300 },
		{ y: '2018-07', a: 500,  b: 200 }
      ],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['In Store', 'Online'],
		fillOpacity: 1,
		lineWidth:0,
		lineColors: ['#1e88e5', '#fc4b6c'],
		hideHover: 'auto'
    });

	
	
//BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: 'Jan', a: 2341, b: 1598},
        {y: 'Feb', a: 2131, b: 2021},
        {y: 'Mar', a: 4374, b: 4120},
        {y: 'Apr', a: 1312, b: 900},
        {y: 'May', a: 4393, b: 3258},
        {y: 'Jun', a: 1210, b: 400}
      ],
		barColors: ['#7460ee', '#ffb22b'],
		barSizeRatio: 0.5,
		barGap:5,
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['On WebSite', 'On Mobile App'],
		hideHover: 'auto'
    });
	
/*****E-Charts function start*****/
		
	if( $('#e_chart_3').length > 0 ){
		var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
		var data = [{
			value: 5713,
			name: ''
		}, {
			value: 8458,
			name: ''
		}, {
			value: 1254,
			name: ''
		}, {
			value: 2589,
			name: ''
		}, {
			value: 7458,
			name: ''
		}, {
			value: 6325,
			name: ''
		}, {
			value: 8452,
			name: ''
		}, {
			value: 9563,
			name: ''
		}, {
			value: 1125,
			name: ''
		}, {
			value: 8546,
			name: ''
		}];
		var option3 = {
			tooltip: {
				show: true,
				trigger: 'item',
				backgroundColor: 'rgba(33,33,33,1)',
				borderRadius:0,
				padding:10,
				formatter: "{b}: {c} ({d}%)",
				textStyle: {
					color: '#fff',
					fontStyle: 'normal',
					fontWeight: 'normal',
					fontFamily: "'Open Sans', sans-serif",
					fontSize: 12
				}	
			},
			series: [{
				type: 'pie',
				selectedMode: 'single',
				radius: ['100%', '30%'],
				color: ['#7460ee', '#e4e7ea', '#26c6da', '#1e88e5', '#ffb22b', '#fc4b6c', '#7c277d', '#FC3468', '#fcc525', '#8d6658'],
				labelLine: {
					normal: {
						show: false
					}
				},
				data: data
			}]
		};
		eChart_3.setOption(option3);
		eChart_3.resize();
	}

/*****E-Charts function end*****/	
	
	
}); // End of use strict

