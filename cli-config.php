<?php
/**
 * Config file of the blog
 *
 * PHP Version 7.+
 *
 * @category  Projet5
 * @package   Projet5
 * @author    Sylvain SAEZ <saez.sylvain@gmail.com>
 * @copyright 2019 Frakdev
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      sylvainsaez.fr
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use System\Database;

require_once __DIR__ . '/' . "vendor/autoload.php";
require_once __DIR__ . '/' . "System/autoload.php";

return ConsoleRunner::createHelperSet(Database::getEntityManager());
