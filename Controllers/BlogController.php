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

    public function singlePost($route)
    {
        /**
         * Get the post by Route
         */
        if ($_SESSION == null) {
            $session = false;
        } else {
            $session = true;
        }
        $comments = true;
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->findOneBy(array('route' => $route));

        $this->render('singlePost.html.twig', ['post' => $post, 'session' => $session, 'comments' => $comments]);
    }

}