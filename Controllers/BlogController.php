<?php


namespace Controllers;

use System\Database;

class BlogController extends Controller
{

    public function blog()
    {
        $entityManager = Database::getEntityManager();
        $posts = $entityManager->getRepository('Entity\\Post')->findBy([], ['id' => 'DESC']);
        $this->render('blog.html.twig', ['posts' => $posts]);

    }

    public function singlePost()
    {
        /**
         * Get the Route of the post
         */
        $route = explode('/', $_SERVER['REQUEST_URI'])[3];


        /**
         * Get the post by Route
         */
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->findOneBy(array('route' => $route));

        $this->render('singlePost.html.twig', ['post' => $post]);
    }

}