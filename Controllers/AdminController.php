<?php


namespace Controllers;

use Entity\Post;
use System\Database;

class AdminController extends Controller
{
    public function adminPage()
    {
        // total of users, total of posts, total of comments(later)
        $totalPosts = self::getPostRepository()->findBy([], ['id' => 'ASC']);
        $totalUsers = self::getUserRepository()->findBy([], ['id' => 'ASC']);
        $totalComs = self::getComsRepository()->findBy([], ['id' => 'ASC']);
        $nbPosts = count($totalPosts);
        $nbUsers = count($totalUsers);
        $nbComs = count($totalComs);
        $posts = self::getPostRepository()->findBy([], ['id' => 'DESC'], 5);

        //user connected at the moment
        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);
        if ($user == null) {
            $this->render('404.html.twig');
        } elseif (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user->isAdmin()) {
                $this->render(
                    'admin.html.twig',
                    ['nbUsers' => $nbUsers,
                        'nbPosts' => $nbPosts,
                        'nbComs' => $nbComs,
                        'posts' => $posts]
                );
            } else {
                $this->render('404.html.twig');
            }
        }
    }

    public function postArticlePage()
    {
        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() == 26) {
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

                        $postRoute = self::getPostRepository()->findOneBy(['route' => $route]);

                        if ($postRoute == !null) {
                            $this->render('postArticle.html.twig', ['double' => true]);
                            exit();
                        } else {
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
                            $this->render('postArticle.html.twig', ['submit' => true, 'post' => $post]);
                            exit();
                        }
                    }
                }
                $this->render('postArticle.html.twig', $errors);
            } elseif ($user->getRole() != 26) {
                $this->render('404.html.twig');
            }
        }
    }

    public function eraseArticle()
    {
        /**
         * Get the Id of the post
         */
        $id = (int)$_GET['postId'];

        /**
         * getting the entity manager
         */
        $entityManager = Database::getEntityManager();

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() != 26) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() == 26) {
                $post = $entityManager->getRepository('Entity\\Post')->find($id);
                $entityManager->remove($post);
                $entityManager->flush();
                $this->listArticle();
            }
        }
    }

    public function listArticle()
    {

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() != 26) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() == 26) {
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
        $id = (int)$_GET['postId'];

        /**
         * getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->find($id);

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);

        if (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user == null) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() != 26) {
                $this->render('404.html.twig');
            } elseif ($user->getRole() == 26) {
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
                        $this->render('postArticle.html.twig', ['changes' => true, 'modify' => true, 'post' => $post]);
                        exit();
                    }
                }
                $this->render('postArticle.html.twig', ['modify' => true, 'post' => $post]);
            }
        }
    }

    public function commentToValidate()
    {
        $entityManager = Database::getEntityManager();
        $comments = $entityManager->getRepository('Entity\\Comment')->findBy(['checked' => 0], ['id' => 'DESC']);

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);
        if ($user == null) {
            $this->render('404.html.twig');
        } elseif (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user->isAdmin()) {
                $this->render('validate.html.twig', ['comments' => $comments]);
            } else {
                $this->render('404.html.twig');
            }
        }
    }

    public function validateComment()
    {
        /**
         * Get the Id of the comment
         */
        $id = (int)$_GET['commentId'];

        /**
         * getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $comment = $entityManager->getRepository('Entity\\comment')->findOneBy(['id' => $id]);

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);
        if ($user == null) {
            $this->render('404.html.twig');
        } elseif (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user->isAdmin()) {
                $checked = 1;
                $comment->setChecked($checked);
                $entityManager->persist($comment);
                $entityManager->flush();

                $comments = $entityManager->getRepository('Entity\\Comment')->findBy(
                    ['checked' => 0],
                    ['id' => 'DESC']
                );
                $this->render('validate.html.twig', ['comments' => $comments, 'success' => true]);
            } else {
                $this->render('404.html.twig');
            }
        }
    }

    public function deleteComment()
    {
        /**
         * Get the Id of the comment
         */
        $id = (int)$_GET['commentId'];

        /**
         * getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $comment = $entityManager->getRepository('Entity\\comment')->find($id);

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);
        if ($user == null) {
            $this->render('404.html.twig');
        } elseif (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user->isAdmin()) {
                $entityManager->remove($comment);
                $entityManager->flush();

                $comments = $entityManager->getRepository('Entity\\Comment')->findBy(
                    ['checked' => 0],
                    ['id' => 'DESC']
                );
                $this->render('validate.html.twig', ['comments' => $comments, 'remove' => true]);
            } else {
                $this->render('404.html.twig');
            }
        }
    }
}
