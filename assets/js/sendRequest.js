const $ = require('jquery');
const bootstrap = require('bootstrap');


$('.footer-btn-send').on('click', function () {
    let data = new FormData($('#requestProduct')[0]);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: '/',
        data: data,
        processData: false,
        contentType: false,
        cache: false,

        success: function (data) {
            $('.btn-close').click();

            const toast = new bootstrap.Toast($('#liveToast'));
            $('.toast-body').empty().append(data.message);
            $('input[name=emailInput]').val("");
            $('input[name=commentInput]').val("");

            toast.show()
        }
    });
})
