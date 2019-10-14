<?php
/**
 * Controller for common pages of the blog
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

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PageController
 *
 * @category Controllers
 * @package  Controllers
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 */
class PageController extends Controller
{
    /**
     * Render the home page and manage the contact form
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function homePage()
    {
        //if there is, get the inputs
        if ($_POST) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            //Mail function
            $to = 'cpt.frak@me.com';
            $email_subject = "Nouveau message de la part de $name";
            $email_body = "Formulaire de contact du site,
                <br> $message <br> Répondre à $email";
            $headers = "From: noreply@sylvainsaez.fr";
            $headers .= "Reply-To: $email";
            mail($to, $email_subject, $email_body, $headers);
            return $this->render('index.html.twig', ['post' => true]);
        }
        return $this->render('index.html.twig');
    }

    /**
     * Render the 404 page for the site
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function errorPage()
    {
        return $this->render('404.html.twig');
    }

    /**
     * Destroy the session and redirect to the home page
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function logout()
    {
        session_destroy();
        $_SESSION = null;
        return $this->homePage();
    }
}
