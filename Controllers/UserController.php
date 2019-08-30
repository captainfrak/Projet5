<?php

namespace Controllers;

use Entity\User;
use System\Database;

class UserController extends Controller
{
    public function loginPage()
    {
        $errors = [];
        if ($_POST) {
            //require_once '../Controllers/bootstrap.php'; [J'ai laissé ça là en attendant]
            $_db = new Database();
            $_db->__construct();

            ini_set('display_errors', 'On');
            $userEmail = htmlentities(htmlspecialchars($_POST['email']));
            $userPassword = htmlentities(htmlspecialchars($_POST['password']));
            $user = $entityManager->getRepository('Entity\User')->findOneBy(array('email' => $userEmail));

            if (!empty($userEmail) && !empty($userPassword)) {


                if ($user->getEmail() == $userEmail) {
                    if (password_verify($userPassword, $user->getPassword())) {
                        return $this->render('blog.html.twig', $errors);
                    }
                } elseif ($user->getEmail() != $userEmail) {

                    return $this->render('login.html.twig', ['hadToRegister' => true]);
                }
            } elseif (!empty($_POST['email']) && empty($_POST['password'])) {
                return $this->render('login.html.twig', ['mdp' => true]);

            } elseif (empty($_POST['email']) && !empty($_POST['password'])) {
                return $this->render('login.html.twig', ['email' => true]);
            } elseif (empty($_POST['email']) && empty($_POST['password'])) {
                return $this->render('login.html.twig', ['mdp' => true, 'email' => true]);
            }
        }
        $this->render('login.html.twig', $errors);
    }

    public function registerPage()
    {
        // Si formulaire envoyé je traite les infos
        //TODO secure against sql injections
        $errors = [];
        if ($_POST) {
            if (!empty($_POST)) {
                require_once '../Controllers/bootstrap.php';

                $name = htmlentities(htmlspecialchars($_POST['name']));
                $firstName = htmlentities(htmlspecialchars($_POST['firstName']));
                $email = htmlentities(htmlspecialchars($_POST['email']));
                $username = htmlentities(htmlspecialchars($_POST['username']));
                $password = password_hash(htmlentities(htmlspecialchars($_POST['password'])), PASSWORD_DEFAULT);

                $user = new User();
                $user
                    ->setName($name)
                    ->setFirstName($firstName)
                    ->setEmail($email)
                    ->setPassword($password)
                    ->setUsername($username);

                $entityManager->persist($user);
                $entityManager->flush();
                return $this->render('register.html.twig', ['submit' => true, 'user' => $user]);

            } else {
                $errors = ['emptyForm' => true];
            }
        }
        return $this->render('register.html.twig', $errors);
    }
}
