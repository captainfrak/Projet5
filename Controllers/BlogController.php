<?php


namespace Controllers;

use Entity\Comment;
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
        // Pour TEST
        if ($_SESSION == null) {
            $session = false;
        } else {
            $session = true;
        }

        // GET EM
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->findOneBy(array('route' => $route));
        $comments = $entityManager->getRepository('Entity\\Comment')->findBy(['postId' => $post->getID()], ['id' => 'DESC']);
        // If $route match with existing route
        if ($post != null) {
            if ($_POST) {
                if (!empty($_POST)) {

                    $author = $_SESSION["user"]->getUsername();
                    $message = $_POST['message'];
                    $checked = 0;
                    $postDate = time();
                    $postId = $post->getId();

                    $comment = new Comment();
                    $comment
                        ->setAuthor($author)
                        ->setMessage($message)
                        ->setChecked($checked)
                        ->setPostdate($postDate)
                        ->setPostId($postId);

                    $entityManager->persist($comment);
                    $entityManager->flush();
                    $this->render('singlePost.html.twig', ['post' => $post, 'session' => $session, 'comments' => $comments, 'succes' => true]);
                    exit();
                }
            }

            $this->render('singlePost.html.twig', ['post' => $post, 'session' => $session, 'comments' => $comments]);

        } else {
            $pageController = new PageController();
            $pageController->errorPage();
        }

    }

}