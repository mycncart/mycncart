/* =================================================================
    Bar chart
================================================================= */

Morris.Bar({
    element: 'bar',
    data: [{
        y: '2011',
        a: 75,
        b: 65,
        c: 40
    }, {
        y: '2012',
        a: 50,
        b: 40,
        c: 30
    }, {
        y: '2013',
        a: 75,
        b: 65,
        c: 40
    }, {
        y: '2014',
        a: 50,
        b: 40,
        c: 30
    }, {
        y: '2015',
        a: 75,
        b: 65,
        c: 40
    }, {
        y: '2016',
        a: 100,
        b: 90,
        c: 40
    }],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['A', 'B', 'C'],
    barColors:['#43b968', '#f59345', '#20b9ae'],
    barSizeRatio: 0.4,
    hideHover: 'auto',
    gridLineColor: '#ddd',
    xLabelAngle: 30,
    resize: true
});

/* =================================================================
    Line chart
================================================================= */

Morris.Line({
    element: 'line',
    resize: true,
    data: [
        {y: '2014 Q1', value: 230},
        {y: '2014 Q2', value: 400},
        {y: '2014 Q3', value: 800},
        {y: '2014 Q4', value: 600},
        {y: '2015 Q1', value: 500},
        {y: '2015 Q2', value: 700},
        {y: '2015 Q3', value: 900},
        {y: '2015 Q4', value: 600},
        {y: '2016 Q1', value: 800},
        {y: '2016 Q2', value: 700}
    ],
    xkey: 'y',
    ykeys: ['value'],
    labels: ['Value'],
    gridLineColor: '#ddd',
    lineColors: ['#3e70c9'],
    lineWidth: 1,
    hideHover: 'auto'
});

/* =================================================================
    Donut chart
================================================================= */

Morris.Donut({
    element: 'donut',
    data: [{
        label: "Series A",
        value: 34,

    }, {
        label: "Series B",
        value: 67
    }, {
        label: "Series C",
        value: 45
    }],
    resize: true,
    colors:['#3e70c9', '#5bc0de', '#a567e2']
});

/* =================================================================
    Area chart
================================================================= */

Morris.Area({
    element: 'area',
    data: [{
        period: '2010',
        SeriesA: 0,
        SeriesB: 0,
        
    }, {
        period: '2011',
        SeriesA: 50,
        SeriesB: 40,
        
    }, {
        period: '2012',
        SeriesA: 30,
        SeriesB: 20,
        
    }, {
        period: '2013',
        SeriesA: 20,
        SeriesB: 30,
        
    }, {
        period: '2014',
        SeriesA: 100,
        SeriesB: 80,
        
    }, {
        period: '2015',
        SeriesA: 40,
        SeriesB: 30,
        
    },
     {
        period: '2016',
        SeriesA: 50,
        SeriesB: 30,
       
    }],
    xkey: 'period',
    ykeys: ['SeriesA', 'SeriesB'],
    labels: ['Series A', 'Series B'],
    pointSize: 0,
    fillOpacity: 0.4,
    pointStrokeColors:['#43b968', '#3e70c9'],
    behaveLikeLine: true,
    gridLineColor: '#e0e0e0',
    lineWidth: 0,
    smooth: false,
    hideHover: 'auto',
    lineColors: ['#43b968', '#3e70c9'],
    resize: true
});

/* =================================================================
    Multiple lines chart
================================================================= */

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