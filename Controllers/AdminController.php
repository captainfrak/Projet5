<?php
/**
 * Controller for administration of the blog
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

use Entity\Post;
use System\Database;

/**
 * Class AdminController
 *
 * @category Controllers
 * @package  Controllers
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 */
class AdminController extends Controller
{
    /**
     * Render the admin dashboard page
     *
     * @return void
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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

    /**
     * Render the page to write new article
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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

                        $postRoute = self::getPostRepository()->findOneBy(
                            ['route' => $route]
                        );

                        if ($postRoute == !null) {
                            $this->render(
                                'postArticle.html.twig',
                                ['double' => true]
                            );
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
                            $this->render(
                                'postArticle.html.twig',
                                ['submit' => true,
                                    'post' => $post]
                            );
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

    /**
     * Method to Erase an article
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function eraseArticle()
    {
        /**
         * Get the Id of the post
         */
        $postId = (int)$_GET['postId'];

        /**
         * Getting the entity manager
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
                $post = $entityManager->getRepository('Entity\\Post')->find($postId);
                $entityManager->remove($post);
                $entityManager->flush();
                $this->listArticle();
            }
        }
    }

    /**
     * Render the page with the list of all blogpost
     *
     * @return void
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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
                $posts = $entityManager->getRepository('Entity\\Post')->findBy(
                    [],
                    ['id' => 'DESC']
                );

                $this->render('listArticle.html.twig', ['posts' => $posts]);
            }
        }
    }

    /**
     * Render the page to modify the article
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function modifyArticle()
    {

        /**
         * Get the Id of the post
         */
        $postId = (int)$_GET['postId'];

        /**
         * Getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->find($postId);

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
                        $this->render(
                            'postArticle.html.twig',
                            ['changes' => true,
                                'modify' => true,
                                'post' => $post]
                        );
                        exit();
                    }
                }
                $this->render(
                    'postArticle.html.twig',
                    ['modify' => true,
                        'post' => $post]
                );
            }
        }
    }

    /**
     * Render the page where comments can be validate
     *
     * @return void
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function commentToValidate()
    {
        $entityManager = Database::getEntityManager();
        $comments = $entityManager->getRepository('Entity\\Comment')->findBy(
            ['checked' => 0],
            ['id' => 'DESC']
        );

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

    /**
     * Method to validate the comment in the backend
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function validateComment()
    {
        /**
         * Get the Id of the comment
         */
        $commentId = (int)$_GET['commentId'];

        /**
         * Getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $comment = $entityManager->getRepository('Entity\\comment')->findOneBy(
            ['id' => $commentId]
        );

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
                $this->render(
                    'validate.html.twig',
                    ['comments' => $comments,
                        'success' => true]
                );
            } else {
                $this->render('404.html.twig');
            }
        }
    }

    /**
     * Method to delete a comment
     *
     * @return void
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function deleteComment()
    {
        /**
         * Get the Id of the comment
         */
        $commentId = (int)$_GET['commentId'];

        /**
         * Getting the entity manager
         */
        $entityManager = Database::getEntityManager();
        $comm = $entityManager->getRepository('Entity\\comment')->find($commentId);

        $user = self::getUserRepository()->findOneBy(['id' => $_SESSION['user']]);
        if ($user == null) {
            $this->render('404.html.twig');
        } elseif (isset($_SESSION)) {
            $_SESSION["user"] = $user;
            if ($user->isAdmin()) {
                $entityManager->remove($comm);
                $entityManager->flush();

                $comments = $entityManager->getRepository('Entity\\Comment')->findBy(
                    ['checked' => 0],
                    ['id' => 'DESC']
                );
                $this->render(
                    'validate.html.twig',
                    ['comments' => $comments,
                        'remove' => true]
                );
            } else {
                $this->render('404.html.twig');
            }
        }
    }
}
