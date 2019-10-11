<?php
/**
 * Controller for the blog pages of the blog
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
use Entity\Comment;
use Entity\User;
use System\Database;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class BlogController
 *
 * @category Controllers
 * @package  Controllers
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 */
class BlogController extends Controller
{

    /**
     * Render the Blog page of the site
     *
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function blog()
    {
        $entityManager = Database::getEntityManager();
        $posts = $entityManager->getRepository('Entity\\Post')->findBy(
            [],
            ['id' => 'DESC']
        );
        return $this->render('blog.html.twig', ['posts' => $posts]);
    }

    /**
     * The method to rendre the single blogpost
     *
     * @param string $route The unique route to go to the blogpost
     *
     * @return string
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function singlePost($route)
    {
        /** @var User $user */
        $user = $_SESSION['user'];

        // GET EM
        $entityManager = Database::getEntityManager();
        $post = $entityManager->getRepository('Entity\\Post')->findOneBy(
            array(
                'route' => $route
            )
        );

        if (!$post) return $this->render('404.html.twig');

        $comments = $entityManager->getRepository('Entity\\Comment')->findBy(
            ['post' => $post, 'checked' => 1],
            ['id' => 'DESC']
        );

        // If $route match with existing route
        if (!empty($_POST)) {
            $author = $_SESSION["user"]->getUsername();
            $message = $_POST['message'];
            $checked = 0;
            $postDate = time();

            $comment = new Comment();
            $comment
                ->setAuthor($author)
                ->setMessage($message)
                ->setChecked($checked)
                ->setPostdate($postDate)
                ->setPost($post);

            $entityManager->persist($comment);
            $entityManager->flush();
            // todo succes VS success, refactor view
            // todo user instead of session
            return $this->render(
                'singlePost.html.twig',
                [
                    'post' => $post,
                    'session' => $user,
                    'comments' => $comments,
                    'succes' => true
                ]
            );

        }

        return $this->render(
            'singlePost.html.twig',
            ['post' => $post,
                'session' => $user,
                'comments' => $comments]
        );
    }
}
