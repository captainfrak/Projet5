<?php
/**
 * Controller for the pages of the blog
 *
 * PHP Version 7.+
 *
 * @category  Controllers
 * @package   Controllers
 * @author    Sylvain SAEZ <saez.sylvain@gmail.com>
 * @copyright 2019 Frakdev
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      sylvainsaez.fr
 */

namespace Controllers;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use System\Database;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

/**
 * Class Controller
 *
 * @category Controllers
 * @package  Controllers
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 */
abstract class Controller
{
    private $twig;
    private static $userRepository = null;
    private static $postRepository = null;
    private static $comsRepository = null;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader("../Views");
        $this->twig = new Environment($loader, ["cache" => false]);
    }

    /**
     * Method to render the Twig Environment
     *
     * @param string $filename the name of the file to render
     * @param array $args arguments to load special features of the page
     *
     *
     * @return void
     * @throws RuntimeError
     * @throws SyntaxError
     *
     * @throws LoaderError
     */
    public function render($filename, $args = array())
    {
        $args['user'] = $_SESSION['user'];

        echo $this->twig->render($filename, $args);
    }

    /**
     * Method to get the Entity Manager
     *
     * @return EntityManager
     */
    protected static function getEntityManager(): EntityManager
    {
        return Database::getEntityManager();
    }

    /**
     * Method to get the userRepository
     *
     * @return ObjectRepository|EntityRepository|null
     */
    protected static function getUserRepository()
    {
        if (self::$userRepository == null) {
            self::$userRepository = self::getEntityManager()
                ->getRepository("Entity\\User");
        }
        return self::$userRepository;
    }

    /**
     * Method to get the postRepository
     *
     * @return ObjectRepository|EntityRepository|null
     */
    protected static function getPostRepository()
    {
        if (self::$postRepository == null) {
            self::$postRepository = self::getEntityManager()
                ->getRepository("Entity\\Post");
        }
        return self::$postRepository;
    }

    /**
     * Method to get the comsRepository
     *
     * @return ObjectRepository|EntityRepository|null
     */
    protected static function getComsRepository()
    {
        if (self::$comsRepository == null) {
            self::$comsRepository = self::getEntityManager()
                ->getRepository("Entity\\Comment");
        }
        return self::$comsRepository;
    }
}
