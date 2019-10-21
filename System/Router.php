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
$user = $_SESSION['user'];

$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$regex = '/\/blog\/article\/([^.]+)/';
$result_matches = array();
try {
    if ($path == "/") {
        $controller = new PageController();
        $controller->homePage();
    } elseif (rtrim($path, '/') == "/blog") {
        $controller = new BlogController();
        $controller->blog();
    } elseif (rtrim($path, '/') == "/login") {
        if (!$user) {
            $controller = new UserController();
            $controller->loginPage();
        } else {
            $controller = new PageController();
            $controller->homePage();
        }
    } elseif (rtrim($path, '/') == "/admin/admin") {
        $controller = new AdminController();
        $controller->adminPage();
    } elseif (rtrim($path, '/') == "/admin/listarticle") {
        $controller = new AdminController();
        $controller->listArticle();
    } elseif (rtrim($path, '/') == "/register") {
        if (!$user) {
            $controller = new UserController();
            $controller->registerPage();
        } else {
            $controller = new PageController();
            $controller->homePage();
        }
    } elseif (rtrim($path, '/') == "/admin/postarticle") {
        $controller = new AdminController();
        $controller->postArticlePage();
    } elseif (preg_match($regex, $path, $result_matches)) {
        $controller = new BlogController();
        $controller->singlePost($result_matches[1]);
    } elseif (rtrim($path, '/') == "/logout") {
        $controller = new PageController();
        $controller->logout();
    } elseif (rtrim($path, '/') == "/admin/erase") {
        $controller = new AdminController();
        $controller->eraseArticle();
    } elseif (rtrim($path, '/') == "/admin/modify") {
        $controller = new AdminController();
        $controller->modifyArticle();
    } elseif (rtrim($path, '/') == "/admin/validation") {
        $controller = new AdminController();
        $controller->commentToValidate();
    } elseif (rtrim($path, '/') == "/admin/validate") {
        $controller = new AdminController();
        $controller->validateComment();
    } elseif (rtrim($path, '/') == "/admin/delete") {
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
