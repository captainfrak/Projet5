<?php

namespace Controllers;

class PageController extends Controller
{
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
            $email_body = "Formulaire de contact du site,<br> $message <br> Répondre à $email";
            $headers = "From: noreply@sylvainsaez.fr";
            $headers .= "Répondre à $email";
            mail($to, $email_subject, $email_body, $headers);
            return $this->render('index.html.twig', ['post' => true]);
        }
        $this->render('index.html.twig');
    }

    public function errorPage()
    {
        $this->render('404.html.twig');
    }

    public function logout()
    {
        session_destroy();
        $_SESSION = null;
        $this->homePage();
    }
}
