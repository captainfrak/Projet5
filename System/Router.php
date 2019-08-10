<?php

require_once __DIR__ . "/autoload.php";
require_once __DIR__ . '/../vendor/autoload.php';


use Controllers\PageController;


$path = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

try {
    if ($path == "/") {
        $controller = new PageController();
        $controller->homePage();
    } else if ($path == "/blog") {
        echo "blog";
    } else {
        echo "404";
    }
} catch (\Exception $e) {
    echo "erreur 500";
}
