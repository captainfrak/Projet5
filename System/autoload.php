<?php
/**
 * Autoloader of the blog
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
spl_autoload_register(
/**
 * Includes required files regarding the name of the class
 *
 * @param string $class the name of the class to include the file
 */
    function ($class) {
        $class = str_replace("\\", "/", $class);
        include_once __DIR__ . "/../" . $class . ".php";
    }
);
