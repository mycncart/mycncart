/* =================================================================
    Pie chart
================================================================= */

$('[data-chart="pie"]').each(function(idx, obj) {
    var colors = $(this).attr('data-colors') ? $(this).attr('data-colors').split(",") : [];
    var width = $(this).attr('data-width') ? $(this).attr('data-width') : 50;
    var height = $(this).attr('data-height') ? $(this).attr('data-height') : 50;
    $(this).peity("pie", {
        fill: colors,
        width: width,
        height: height
    });
});

/* =================================================================
    Donut chart
================================================================= */

 $('[data-chart="donut"]').each(function(idx, obj) {
    var colors = $(this).attr('data-colors') ? $(this).attr('data-colors').split(",") : [];
    var width = $(this).attr('data-width') ? $(this).attr('data-width'):20;
    var height = $(this).attr('data-height') ? $(this).attr('data-height'):20;
    $(this).peity("donut", {
        fill: colors,
        width: width,
        height: height
    });
});

/* =================================================================
    Donut chart
================================================================= */

$('[data-chart="line"]').each(function(idx, obj) {
    $(this).peity("line", $(this).data());
});

/* =================================================================
    Bar chart
================================================================= */

$('[data-chart="bar"]').each(function(idx, obj) {
    var colors = $(this).attr('data-colors') ? $(this).attr('data-colors').split(",") : [];
    var width = $(this).attr('data-width') ? $(this).attr('data-width'):20;
    var height = $(this).attr('data-height') ? $(this).attr('data-height'):20;
    $(this).peity("bar", {
        fill: colors,
        width: width,
        height: height
    });
});