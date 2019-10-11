<?php
/**
 * Router of the blog
 *
 * PHP Version 7.+
 *
 * @category  System
 * @package   System
 * @author    Sylvain SAEZ <saez.sylvain@gmail.com>
 * @copyright 2019 Frakdev
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      sylvainsaez.fr
 */
error_reporting(E_ALL);
require_once __DIR__ . "/autoload.php";
require_once __DIR__ . '/../vendor/autoload.php';


use Controllers\AdminController;
use Controllers\BlogController;
use Controllers\PageController;
use Controllers\UserController;

session_start();

$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$regex = '/\/blog\/article\/([^.]+)/';
$result_matches = array();
try {
    if ($path == "/") {
        $controller = new PageController();
        echo $controller->homePage();
    } elseif (rtrim($path, '/') == "/blog") {
        $controller = new BlogController();
        echo $controller->blog();
    } elseif (rtrim($path, '/') == "/login") {
        $controller = new UserController();
        echo $controller->loginPage();
    } elseif (rtrim($path, '/') == "/admin/admin") {
        $controller = new AdminController();
        echo $controller->adminPage();
    } elseif (rtrim($path, '/') == "/admin/listarticle") {
        $controller = new AdminController();
        echo $controller->listArticle();
    } elseif (rtrim($path, '/') == "/register") {
        $controller = new UserController();
        echo $controller->registerPage();
    } elseif (rtrim($path, '/') == "/admin/postarticle") {
        $controller = new AdminController();
        echo $controller->postArticlePage();
    } elseif (preg_match($regex, $path, $result_matches)) {
        $controller = new BlogController();
        echo $controller->singlePost($result_matches[1]);
    } elseif (rtrim($path, '/') == "/logout") {
        $controller = new PageController();
        echo $controller->logout();
    } elseif (rtrim($path, '/') == "/admin/erase") {
        $controller = new AdminController();
        echo $controller->eraseArticle();
    } elseif (rtrim($path, '/') == "/admin/modify") {
        $controller = new AdminController();
        echo $controller->modifyArticle();
    } elseif (rtrim($path, '/') == "/admin/validation") {
        $controller = new AdminController();
        echo $controller->commentToValidate();
    } elseif (rtrim($path, '/') == "/admin/validate") {
        $controller = new AdminController();
        echo $controller->validateComment();
    } elseif (rtrim($path, '/') == "/admin/delete") {
        $controller = new AdminController();
        echo $controller->deleteComment();
    } else {
        $controller = new PageController();
        echo $controller->errorPage();
    }
} catch (Throwable $e) {
    if ($_SERVER['SERVER_NAME'] == 'blog.local') {
        echo $e->getMessage();
    } else {
        echo "erreur 500";
    }
}
