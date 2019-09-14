<?php


namespace Controllers;

use Doctrine\ORM\EntityManager;
use System\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private $twig;
    private static $userRepository = null;
    private static $postRepository = null;

    public function __construct()
    {
        $loader = new FilesystemLoader("../Views");
        $this->twig = new Environment($loader, ["cache" => false]);
    }

    public function render($filename, $args = array())
    {
        $args['user'] = $_SESSION['user'];
        echo $this->twig->render($filename, $args);
    }

    protected static function getEntityManager(): EntityManager
    {
        return Database::getEntityManager();
    }

    protected static function getUserRepository()
    {
        if (self::$userRepository == null) {
            self::$userRepository = self::getEntityManager()
                ->getRepository("Entity\\User");
        }
        return self::$userRepository;
    }

    protected static function getPostRepository()
    {
        if (self::$postRepository == null) {
            self::$postRepository = self::getEntityManager()
                ->getRepository("Entity\\Post");
        }
        return self::$postRepository;
    }
}