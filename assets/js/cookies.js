const $ = require('jquery');

$(document).ready(function () {
    if ($.cookie('width') == null || $.cookie('width') != $(window).width()) {
        let width = $(window).width();

        $.cookie('width', width);
    }
})