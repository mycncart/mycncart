$(document).ready(function() {
   var sparkline = function() { 

        /* =================================================================
            Line chart
        ================================================================= */

        $('#sparkline1').sparkline([0, 42, 78, 63, 120, 30, 12, 32, 63], {
            type: 'line',
            width: $('#sparkline1').width(),
            height: '180',
            chartRangeMax: 50,
            lineColor: '#a567e2',
            fillColor: 'rgba(165, 103, 226, 0.3)',
            highlightLineColor: 'rgba(0,0,0, 0.1)',
            highlightSpotColor: 'rgba(0,0,0, 0.2)',
        });

        $('#sparkline1').sparkline([11, 15, 23, 36, 20, 40, 35, 55, 70], {
            type: 'line',
            width: $('#sparkline1').width(),
            height: '180',
            chartRangeMax: 50,
            lineColor: '#f44236',
            fillColor: 'rgba(244, 66, 54, 0.3)',
            composite: true,
            highlightLineColor: 'rgba(0, 0, 0, 0.1)',
            highlightSpotColor: 'rgba(0, 0, 0, 0.2)',
        });

        $('#sparkline2').sparkline([0, 16, 30, 70, 30, 40, 67, 23, 44], {
            type: 'line',
            width: $('#sparkline2').width(),
            height: '180',
            chartRangeMax: 50,
            lineColor: '#20b9ae',
            fillColor: 'transparent',
            highlightLineColor: 'rgba(255,2 55, 255, 0.1)',
            highlightSpotColor: 'rgba(255,2 55, 255, 0.1)'
        });
    
        /* =================================================================
            Pie chart
        ================================================================= */

        $('#sparkline3').sparkline([40, 33, 15], {
            type: 'pie',
            width: '180',
            height: '180',
            sliceColors: ['#f44236', '#f59345', '#ddd']
        });
    
        /* =================================================================
            Bar chart
        ================================================================= */

        $('#sparkline4').sparkline([15, 18, 14, 12, 19, 10, 6, 17, 19, 20, 25, 23, 29, 32, 30, 27], {
            type: 'bar',
            height: '165',
            barWidth: '10',
            barSpacing: '3',
            barColor: '#a567e2'
        });
        
        $('#sparkline5').sparkline([15, 18, 14, 12, 19, 10, 6, 17, 19, 20, 25, 23, 29, 32, 30, 27], {
            type: 'bar',
            height: '165',
            barWidth: '10',
            barSpacing: '3',
            barColor: '#43b968'
        });
    
        $('#sparkline5').sparkline([15, 18, 14, 12, 19, 10, 6, 17, 19, 20, 25, 23, 29, 32, 30, 27], {
            type: 'line',
            width: $('#sparkline1').width(),
            height: '165',
            lineColor: '#ff5d48',
            fillColor: 'transparent',
            composite: true,
            highlightLineColor: 'rgba(0, 0, 0, 0.1)',
            highlightSpotColor: 'rgba(0, 0, 0, 0.2)',
        });

    }

    var sparklineResize;
 
    $(window).resize(function(e) {
        clearTimeout(sparklineResize);
        sparklineResize = setTimeout(sparkline, 500);
    });

    sparkline();

});