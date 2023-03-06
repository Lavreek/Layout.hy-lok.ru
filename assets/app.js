/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import './css/body-another.css';
import './css/body-banner.css';
import './css/body-catalogs.css';
import './css/body-certificates.css';
import './css/body-info.css';
import './css/body-production.css';
import './css/body-scroll.css';
import './css/footer.css';
import './css/general.css';
import './css/header.css';
import './css/modal.css';
import './css/toast.css';
import './css/text.css';

import './media/media-320.css';
import './media/media-425.css';
import './media/media-768.css';

const $ = require('jquery');
import './js/jquery.cookie';

import './js/popper.min';
import './js/collapse';
import './js/cookies';

// start the Stimulus application

const bootstrap = require('bootstrap');
import './bootstrap';

import './js/sendRequest';
import './js/scroll';
import './js/jquery.cookie'


$(document).ready(function () {
    // Initialize the agent at application startup.
    const fpPromise = new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.onload = resolve;
        script.onerror = reject;
        script.async = true;
        script.src = 'https://cdn.jsdelivr.net/npm/'
            + '@fingerprintjs/fingerprintjs-pro@3/dist/fp.min.js';
        document.head.appendChild(script);
    })
        .then(() => FingerprintJS.load({token: 'h7x0DxO8VolroOKyIOMk'}));

    // Get the visitor identifier when you need it.
    fpPromise
        .then(fp => fp.get())
        .then(result => {
            // This is the visitor identifier:
            const visitorId = result.visitorId;
            let width = $(window).width();

            $.cookie('FINGERPRINT_ID', visitorId);
            $.cookie('width', width);

            $.ajax({
                type: "POST",
                url: '/visit',
                data:
                    'FINGERPRINT_ID=' + visitorId +
                    '&Width=' + width,

                success: function (data) {
                    if (data['params']['vid'] !== undefined) {
                        let vid = data['params']['vid'];

                        $('.link-mailto').attr('href', 'mailto:' + vid + "@hy-lok.ru");
                        $('.mail-text').empty().append(vid);
                        $.cookie('vid', vid);
                    }
                }
            });
        })
})
