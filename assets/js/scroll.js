const $ = require('jquery');

$(document).scroll(function () {
    let header = $('header');

    if ($(window).scrollTop() > header.height()) {
        header.addClass('header-shadow');
    } else {
        if (header.hasClass('header-shadow')) {
            header.removeClass('header-shadow');
        }
    }
})

$('.button-prev').on('click', function () {
    let certs = $('.hylok-carousel-container');
    let imgWidth = $('.certificate').width();
    let result = Math.trunc(imgWidth + $(window).width() * 0.05199);

    certs.animate( { scrollLeft: '-=' + result }, 500);
})

$('.button-next').on('click', function () {
    let certs = $('.hylok-carousel-container');
    let imgWidth = $('.certificate').width();
    let result = Math.trunc(imgWidth + $(window).width() * 0.05199);

    certs.animate( { scrollLeft: '+=' + result }, 500);
})