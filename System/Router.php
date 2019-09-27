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
    } else if (rtrim($path, '/') == "/admin/admin") {
        $controller = new AdminController();
        $controller->adminPage();
    } else if (rtrim($path, '/') == "/admin/listarticle") {
        $controller = new AdminController();
        $controller->listArticle();
    } else if (rtrim($path, '/') == "/register") {
        $controller = new UserController();
        $controller->registerPage();
    } else if (rtrim($path, '/') == "/admin/postarticle") {
        $controller = new AdminController();
        $controller->postArticlePage();
    } else if (preg_match($regex, $path, $result_matches)) {
        $controller = new BlogController();
        $controller->singlePost($result_matches[1]);
    } else if (rtrim($path, '/') == "/logout") {
        $controller = new PageController();
        $controller->logout();
    } else if (rtrim($path, '/') == "/admin/erase") {
        $controller = new AdminController();
        $controller->eraseArticle();
    } else if (rtrim($path, '/') == "/admin/modify") {
        $controller = new AdminController();
        $controller->modifyArticle();
    } else if (rtrim($path, '/') == "/admin/validation") {
        $controller = new AdminController();
        $controller->CommentToValidate();
    } else if (rtrim($path, '/') == "/admin/validate") {
        $controller = new AdminController();
        $controller->validateComment();
    } else if (rtrim($path, '/') == "/admin/delete") {
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
