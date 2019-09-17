<?php


namespace Controllers;

use Entity\Post;
use System\Database;

class AdminController extends Controller
{
    public function adminPage()
    {
        // total of users, total of posts, total of comments(later)
        $totalPosts = self::getPostRepository('Entity\Post')->findBy([], ['id' => 'ASC']);
        $totalUsers = self::getUserRepository('Entity\User')->findBy([], ['id' => 'ASC']);
        $nbPosts = count($totalPosts);
        $nbUsers = count($totalUsers);
        $nbComs = 0;

        //user connected at the moment
        $user = self::getUserRepository('Entity\User')->findOneBy(['id' => $_SESSION['user']]);
        if ($user == null) {
            $this->render('404.html.twig');
        } else if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user->getRole() == 26) {
                $this->render('admin.html.twig', ['nbUsers' => $nbUsers, 'nbPosts' => $nbPosts, 'nbComs' => $nbComs]);
            } else if ($user->getRole() != 26) {
                $this->render('404.html.twig');
            }
        }
    }

    public function postArticlePage()
    {
        $user = self::getUserRepository('Entity\User')->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } else if ($user->getRole() == 26) {
                $errors = [];
                if ($_POST) {
                    if (!empty($_POST)) {

                        $entityManager = Database::getEntityManager();

                        $title = $_POST['title'];
                        $chapo = $_POST['chapo'];
                        $contentText = $_POST['content'];
                        $author = $_POST['author'];
                        $route = $_POST['route'];
                        $date = time();

                        $post = new Post();
                        $post
                            ->setTitle($title)
                            ->setChapo($chapo)
                            ->setContentText($contentText)
                            ->setAuthor($author)
                            ->setRoute($route)
                            ->setDateCreation($date);

                        $entityManager->persist($post);
                        $entityManager->flush();
                        return $this->render('postArticle.html.twig', ['submit' => true, 'post' => $post]);
                    }
                }
                $this->render('postArticle.html.twig');
            } else if ($user->getRole() != 26) {
                $this->render('404.html.twig');
            }
        }
    }

    public function eraseArticle()
    {
        /**
         * Get the Id of the post
         */
        $url = explode('?', $_SERVER['REQUEST_URI'], 0)[0];
        $character_mask = "/erase?";
        $id = ltrim($url, $character_mask);

        /**
         * getting the entity manager
         */
        $entityManager = Database::getEntityManager();

        $user = self::getUserRepository('Entity\User')->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } else if ($user->getRole() != 26) {
                $this->render('404.html.twig');
            } else if ($user->getRole() == 26) {
                $post = $entityManager->getRepository('Entity\\Post')->find($id);
                $entityManager->remove($post);
                $entityManager->flush();
                $this->listArticle();
            }
        }
    }

    public function listArticle()
    {

        $user = self::getUserRepository('Entity\User')->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } else if ($user->getRole() != 26) {
                $this->render('404.html.twig');
            } else if ($user->getRole() == 26) {
                $entityManager = Database::getEntityManager();
                $posts = $entityManager->getRepository('Entity\\Post')->findBy([], ['id' => 'DESC']);

                $this->render('listArticle.html.twig', ['posts' => $posts]);
            }
        }
    }

    public function modifyArticle()
    {
        /**
         * Get the Id of the post
         */
        $url = explode('?', $_SERVER['REQUEST_URI'], 0)[0];
        $character_mask = "/modify?";
        $id = ltrim($url, $character_mask);

        /**
         * getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->find($id);

        $user = self::getUserRepository('Entity\User')->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } else if ($user->getRole() != 26) {
                $this->render('404.html.twig');
            } else if ($user->getRole() == 26) {
                if ($_POST) {
                    if (!empty($_POST)) {

                        $entityManager = Database::getEntityManager();

                        $title = $_POST['title'];
                        $chapo = $_POST['chapo'];
                        $contentText = $_POST['content'];
                        $author = $_POST['author'];
                        $route = $_POST['route'];
                        $date = time();

                        $post
                            ->setTitle($title)
                            ->setChapo($chapo)
                            ->setContentText($contentText)
                            ->setAuthor($author)
                            ->setRoute($route)
                            ->setDateCreation($date);

                        $entityManager->persist($post);
                        $entityManager->flush();
                        return $this->render('postArticle.html.twig', ['changes' => true, 'modify' => true, 'post' => $post]);
                    }
                }
                $this->render('postArticle.html.twig', ['modify' => true, 'post' => $post]);
            }
        }
    }
}