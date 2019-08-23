<?php

namespace Controllers;

class PageController extends Controller
{
    public function homePage()
    {
        $this->render('index.html.twig');
    }

    public function loginPage()
    {
        $this->render('login.html.twig');
    }

    public function adminPage()
    {
        $this->render('admin.html.twig');
    }

    public function registerPage()
    {
        $this->render('register.html.twig');
    }

    public function postArticlePage()
    {
        $this->render('postArticle.html.twig');
    }

    public function blog()
    {
        $this->render('blog.html.twig');
    }

    public function single_post()
    {
        $this->render('single_post.html.twig');
    }
}
