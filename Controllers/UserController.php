<?php
/**
 * Controller for user part of the blog
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

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Entity\User;
use System\Database;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class UserController
 *
 * @category Controllers
 * @package  Controllers
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 */
class UserController extends Controller
{
    /**
     * Returns the Login Page For the user to log himself
     *
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function loginPage()
    {
        if ($_POST) {
            $userEmail = htmlentities(htmlspecialchars($_POST['email']));
            $userPassword = htmlentities(htmlspecialchars($_POST['password']));
            $user = self::getUserRepository()->findOneBy(['email' => $userEmail]);

            if (!empty($userEmail) && !empty($userPassword)) {
                if ($user == !$userEmail) {
                    return $this->render(
                        'login.html.twig',
                        ['hadToRegister' => true]
                    );
                } elseif ($user->getEmail() == $userEmail) {
                    if (password_verify($userPassword, $user->getPassword())) {
                        $_SESSION["user"] = $user;
                        if ($user->isAdmin()) {
                            header('Location: /admin/admin');
                        } else {
                            return $this->render('index.html.twig');
                        }
                    } else {
                        return $this->render(
                            'login.html.twig',
                            ['checkmdp' => true, 'emailForm' => $userEmail]
                        );
                    }
                }
            }
        }
        return $this->render('login.html.twig');
    }

    /**
     * Return the Page for user to register
     *
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function registerPage()
    {
        $errors = [];
        if ($_POST) {
            if (!empty($_POST)) {
                $entityManager = Database::getEntityManager();

                $name = htmlentities(htmlspecialchars($_POST['name']));
                $firstName = htmlentities(htmlspecialchars($_POST['firstName']));
                $email = htmlentities(htmlspecialchars($_POST['email']));
                $username = htmlentities(htmlspecialchars($_POST['username']));
                $password = password_hash(
                    htmlentities(
                        htmlspecialchars(
                            $_POST['password']
                        )
                    ),
                    PASSWORD_DEFAULT
                );
                $role = htmlentities(htmlspecialchars($_POST['role']));

                $userEmail = self::getUserRepository()->findOneBy(['email' => $email]);

                if ($userEmail === null) {
                    $user = new User();
                    $user
                        ->setName($name)
                        ->setFirstName($firstName)
                        ->setEmail($email)
                        ->setRole($role)
                        ->setPassword($password)
                        ->setUsername($username);

                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->render(
                        'register.html.twig',
                        ['submit' => true,
                            'user' => $user]
                    );
                } else {
                    return $this->render('register.html.twig', ['badmail' => true]);
                }
            } else {
                $errors = ['emptyForm' => true];
            }
        }
        return $this->render('register.html.twig', $errors);
    }
}
