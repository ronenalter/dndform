$(function () {
    $('div :input[type=text]').not('#pager input').fancyInput()[0].focus();
    $("#results").tablesorter({ widthFixed: true, widgets: ['zebra'] })
    .tablesorterPager({container: $("#pager")}); 
});

