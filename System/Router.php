<?php
error_reporting(E_ALL);
require_once __DIR__ . "/autoload.php";
require_once __DIR__ . '/../vendor/autoload.php';


use Controllers\AdminController;
use Controllers\BlogController;
use Controllers\PageController;
use Controllers\UserController;

session_start();
if (!isset($_SESSION)) {
    $_SESSION = null;
}
$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$regex = '/\/blog\/article\/([^.]+)/';
$result_matches = array();
try {
    if ($path == "/") {
        $controller = new PageController();
        $controller->homePage();
    } else if (rtrim($path, '/') == "/blog") {
        $controller = new BlogController();
        $controller->blog();
    } else if (rtrim($path, '/') == "/login") {
        $controller = new UserController();
        $controller->loginPage();
    } else if (rtrim($path, '/') == "/admin") {
        $controller = new AdminController();
        $controller->adminPage();
    } else if (rtrim($path, '/') == "/listarticle") {
        $controller = new AdminController();
        $controller->listArticle();
    } else if (rtrim($path, '/') == "/register") {
        $controller = new UserController();
        $controller->registerPage();
    } else if (rtrim($path, '/') == "/postarticle") {
        $controller = new AdminController();
        $controller->postArticlePage();
    } else if (preg_match($regex, $path, $result_matches)) {
        $controller = new BlogController();
        $controller->singlePost($result_matches[1]);
    } else if (rtrim($path, '/') == "/logout") {
        $controller = new PageController();
        $controller->logout();
    } else if (rtrim($path, '/') == "/erase") {
        $controller = new AdminController();
        $controller->eraseArticle();
    } else if (rtrim($path, '/') == "/modify") {
        $controller = new AdminController();
        $controller->modifyArticle();
    } else if (rtrim($path, '/') == "/validation") {
        $controller = new AdminController();
        $controller->CommentToValidate();
    } else if (rtrim($path, '/') == "/validate") {
        $controller = new AdminController();
        $controller->validateComment();
    } else if (rtrim($path, '/') == "/delete") {
        $controller = new AdminController();
        $controller->deleteComment();
    } else {
        $controller = new PageController();
        $controller->errorPage();
    }
} catch (Throwable $e) {
    if ($_SERVER['SERVER_NAME'] == 'blog.local') {
        echo $e->getMessage();
    } else {
        echo "erreur 500";
    }
}
