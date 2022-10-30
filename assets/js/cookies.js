$(document).ready(function () {
    if ($.cookie('width') == null || $.cookie('width') != $(window).width()) {

        $.cookie('width', $(window).width());
        window.location.reload();
    }
})