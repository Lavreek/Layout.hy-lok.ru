<?php
    session_start();
    error_reporting(0);

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
            case ($width <= 576):
                $certificates = putCertificates(2);
                break;

            case ($width <= 1440 and $width > 576):
                $certificates = putCertificates(3);
                break;

            case ($width <= 1920 and $width > 1440):
                $certificates = putCertificates(4);
                break;

            default:
                $certificates = putCertificates(4);
                break;
        }
    }

    $catalogs = putCatalogs(5);

    if (isset($_POST['emailInput'], $_POST['commentInput'], $_COOKIE['width'])) {
        if ($_POST['emailInput'] != "" and $_POST['commentInput'] != "" and $_COOKIE['width'] > 0) {
            if (!isset($_SESSION['last_comment']) or $_SESSION['last_comment'] != md5($_POST['commentInput'])) {
                $email = addslashes($_POST['emailInput']);
                $comment = addslashes($_POST['commentInput']);

                $u_ip = $u_ym_uid = $u_geo = $u_width = "";

                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $u_ip = $_SERVER['REMOTE_ADDR'];
                }

                if (isset($_COOKIE['_ym_uid'])) {
                    $u_ym_uid = $_COOKIE['_ym_uid'];
                }

                if (isset($_SERVER['GEOIP_COUNTRY_NAME'])) {
                    $u_geo .= $_SERVER['GEOIP_COUNTRY_NAME'] . " / ";
                }

                if (isset($_SERVER['GEOIP_REGION'])) {
                    $u_geo .= $_SERVER['GEOIP_REGION'] . " / ";
                }

                if (isset($_SERVER['GEOIP_CITY'])) {
                    $u_geo .= $_SERVER['GEOIP_CITY'] . " / ";
                }

                if (isset($_COOKIE['width'])) {
                    $u_width = $_COOKIE['width'];
                }

                $link = new mysqli('fluidline.beget.tech', 'fluidline_hy_lok', 'K3&PrZMJ', 'fluidline_hy_lok', 3306);
                $link->query(
                    "INSERT INTO `user_request` (`u_mail`, `u_comment`, `u_ip`, `u_ym_uid`, `u_geo`, `u_width`) VALUES ('$email', '$comment', '$u_ip', '$u_ym_uid', '$u_geo', '$u_width')"
                );

                $_SESSION['last_comment'] = md5($comment);
            }
        }
    }

include __DIR__ . "/page.html";