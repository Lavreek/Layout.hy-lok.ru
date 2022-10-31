$(document).ready(function () {
    if ($.cookie('width') == null || $.cookie('width') != $(window).width()) {
        let width = $(window).width();

        $.cookie('width', width);

        // switch(width) {
        //     case (width > 1440):
        //         $.cookie('widthType', 'fluid');
        //         break;
        //
        //     case (width > 768):
        //         $.cookie('widthType', 'lg');
        //         break;
        //
        //     case (width >= 576):
        //         $.cookie('widthType', 'md');
        //         break;
        //
        //     case (width < 576):
        //         $.cookie('widthType', 'sm');
        //         break;
        // }

        window.location.reload();
    }
})