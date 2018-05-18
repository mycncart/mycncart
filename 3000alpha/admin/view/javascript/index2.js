$(document).ready(function(){

  /* Advanced Smil Animations */
  var chart = new Chartist.Line('#advanced', {
    labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
    series: [
      [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
      [4,  5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
      [5,  3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
      [3,  4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
    ]
  }, {
    chartPadding: {
      right: 21,
      left: -8,
      top: 20,
      bottom: 0
    },
    low: 0
  });

  // Let's put a sequence number aside so we can use it in the event callbacks
  var seq = 0,
    delays = 80,
    durations = 500;

  // Once the chart is fully created we reset the sequence
  chart.on('created', function() {
    seq = 0;
  });

  // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
  chart.on('draw', function(data) {
    seq++;

    if(data.type === 'line') {
      // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
      data.element.animate({
        opacity: {
          // The delay when we like to start the animation
          begin: seq * delays + 1000,
          // Duration of the animation
          dur: durations,
          // The value where the animation should start
          from: 0,
          // The value where it should end
          to: 1
        }
      });
    } else if(data.type === 'label' && data.axis === 'x') {
      data.element.animate({
        y: {
          begin: seq * delays,
          dur: durations,
          from: data.y + 100,
          to: data.y,
          // We can specify an easing function from Chartist.Svg.Easing
          easing: 'easeOutQuart'
        }
      });
    } else if(data.type === 'label' && data.axis === 'y') {
      data.element.animate({
        x: {
          begin: seq * delays,
          dur: durations,
          from: data.x - 100,
          to: data.x,
          easing: 'easeOutQuart'
        }
      });
    } else if(data.type === 'point') {
      data.element.animate({
        x1: {
          begin: seq * delays,
          dur: durations,
          from: data.x - 10,
          to: data.x,
          easing: 'easeOutQuart'
        },
        x2: {
          begin: seq * delays,
          dur: durations,
          from: data.x - 10,
          to: data.x,
          easing: 'easeOutQuart'
        },
        opacity: {
          begin: seq * delays,
          dur: durations,
          from: 0,
          to: 1,
          easing: 'easeOutQuart'
        }
      });
    } else if(data.type === 'grid') {
      // Using data.axis we get x or y which we can use to construct our animation definition objects
      var pos1Animation = {
        begin: seq * delays,
        dur: durations,
        from: data[data.axis.units.pos + '1'] - 30,
        to: data[data.axis.units.pos + '1'],
        easing: 'easeOutQuart'
      };

      var pos2Animation = {
        begin: seq * delays,
        dur: durations,
        from: data[data.axis.units.pos + '2'] - 100,
        to: data[data.axis.units.pos + '2'],
        easing: 'easeOutQuart'
      };

      var animations = {};
      animations[data.axis.units.pos + '1'] = pos1Animation;
      animations[data.axis.units.pos + '2'] = pos2Animation;
      animations['opacity'] = {
        begin: seq * delays,
        dur: durations,
        from: 0,
        to: 1,
        easing: 'easeOutQuart'
      };

      data.element.animate(animations);
    }
  });

  // For the sake of the example we update the chart every time it's created with a delay of 10 seconds
  chart.on('created', function() {
    if(window.__exampleAnimateTimeout) {
      clearTimeout(window.__exampleAnimateTimeout);
      window.__exampleAnimateTimeout = null;
    }
    window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 120000);
  });

  /* Multiple lines chart */
  Morris.Area({
      element: 'multiple',
      data: [{
          period: '2010',
          adidas: 120,
          nike: 110,
          lacoste: 40
      }, {
          period: '2011',
          adidas: 180,
          nike: 130,
          lacoste: 170
      }, {
          period: '2012',
          adidas: 120,
          nike: 170,
          lacoste: 100
      }, {
          period: '2013',
          adidas: 90,
          nike: 130,
          lacoste: 40
      }, {
          period: '2014',
          adidas: 120,
          nike: 150,
          lacoste: 70
      }, {
          period: '2015',
          adidas: 60,
          nike: 70,
          lacoste: 90
      },
       {
          period: '2016',
          adidas: 170,
          nike: 190,
          lacoste: 140
      }],
      xkey: 'period',
      ykeys: ['adidas', 'nike', 'lacoste'],
      labels: ['Adidas', 'Nike', 'Lacoste'],
      pointSize: 3,
      fillOpacity: 0,
      pointStrokeColors:['#f44236', '#43b968', '#20b9ae'],
      behaveLikeLine: true,
      gridLineColor: '#e0e0e0',
      lineWidth: 1,
      hideHover: 'auto',
      lineColors: ['#f44236', '#43b968', '#20b9ae'],
      resize: true
  });

});