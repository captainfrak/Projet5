<?php
error_reporting(E_ALL);
require_once __DIR__ . "/autoload.php";
require_once __DIR__ . '/../vendor/autoload.php';


use Controllers\PageController;


$path = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

try {
    if ($path == "/") {
        $controller = new PageController();
        $controller->homePage();
    } else if ($path == "/blog") {
        $controller = new PageController();
        $controller->blog();
    } else if ($path == "/login") {
        $controller = new PageController();
        $controller->loginPage();
    } else if ($path == "/admin") {
        $controller = new PageController();
        $controller->adminPage();
    } else if ($path == "/register") {
        $controller = new PageController();
        $controller->registerPage();
    } else if ($path == "/postarticle") {
        $controller = new PageController();
        $controller->postArticlePage();
    } else if ($path == "/single_post") {
        $controller = new PageController();
        $controller->single_post();
    } else {
        echo "404";
    }
} catch (\Throwable $e) {
    if ($_SERVER['SERVER_NAME'] == 'blog.local') {
        echo $e->getMessage();
    } else {
        echo "erreur 500";
    }
}
