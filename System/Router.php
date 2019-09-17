<?php
error_reporting(E_ALL);
require_once __DIR__ . "/autoload.php";
require_once __DIR__ . '/../vendor/autoload.php';


use Controllers\AdminController;
use Controllers\BlogController;
use Controllers\PageController;
use Controllers\UserController;
use System\Database;

session_start();
if (!isset($_SESSION)) {
    $_SESSION = null;
}
$path = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$route = explode('/', $_SERVER['REQUEST_URI'])[3];
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

    } else if (rtrim($path, '/') == "/blog/article/$route") {
        if (preg_match($regex, $path, $result_matches)) {
            $entityManager = Database::getEntityManager();
            $post = $entityManager->getRepository('Entity\\Post')->findOneBy(array('route' => $route));
            if ($post == !null) {
                $controller = new BlogController();
                $controller->singlePost();
            } elseif ($post == null) {
                $controller = new PageController();
                $controller->errorPage();
            }
        }

    } else if (rtrim($path, '/') == "/logout") {
        $controller = new PageController();
        $controller->logout();
    } else if (rtrim($path, '/') == "/erase") {
        $controller = new AdminController();
        $controller->eraseArticle();
    } else if (rtrim($path, '/') == "/modify") {
        $controller = new AdminController();
        $controller->modifyArticle();
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
