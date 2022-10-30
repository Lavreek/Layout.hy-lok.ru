<?php
    $base = "<base href=\"{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}/\">";

    $media = "";

    if (isset($_COOKIE['width'])) {
        $width = $_COOKIE['width'];
        switch ($width) {
            case (1024 < $width and $width < 1440):
                $media = "<link rel='stylesheet' href='assets/media/media-1440.css'>";
                break;
        }
    }

    include __DIR__ . "/page.html";