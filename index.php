<?php
    $base = "<base href=\"{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/\">";

    $media = "";
    $certificates = "";

    $catalogArray = [
        "<!--noindex-->Каталог фитингов и труб<!--/noindex-->",
        "<!--noindex-->Каталог клапанов<!--/noindex-->",
        "<!--noindex-->Каталог<!--/noindex--> для чистых сред ZCR",
        "<!--noindex-->Каталог<!--/noindex--> интрументальных манифольдов",
        "<!--noindex-->Каталог фитингов под приварку<!--/noindex-->",
    ];

    function putCatalogs($count)
    {
        global  $catalogArray;

        $result = "";

        for ($i = 0; $i < $count; $i++) {
            $result .= "<div class='catalog'><div class='image'><img src='assets/catalog.svg'></div><div class='description'><p class='text'>$catalogArray[$i]</p><a class='link' href='#' download>Скачать</a></div></div>";
        }

        return $result;
    }

    function putCertificates($count)
    {
        $result = "";

        for ($i = 1; $i <= $count; $i++) {
            $result .= "<div class='cert'><img src='assets/certs/cert$i.png'></div>";
        }

        return $result;
    }


    if (isset($_COOKIE['width'])) {
        $width = $_COOKIE['width'];

        switch ($width) {
            case ($width < 425 ):
                $certificates = putCertificates(2);
                break;

            case ($width >= 425 or $width <= 1440):
                $certificates = putCertificates(3);
                break;

            default:
                $certificates = putCertificates(4);
                break;
        }
    }

    $catalogs = putCatalogs(5);




include __DIR__ . "/page.html";