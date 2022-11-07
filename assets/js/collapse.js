$('.btn-show-more').on('click', function () {
    let catalogs = $('.catalogs');

    if (catalogs.hasClass('hide')) {
        $('.catalogs')
            .addClass('show')
            .removeClass(['catalogs-row', 'hide']);
        $(this).empty().append('Свернуть');

    } else if (catalogs.hasClass('show')) {
        $('.catalogs')
            .addClass(['catalogs-row', 'hide'])
            .removeClass('show');

        $(this).empty().append('Показать больше');
    }
});