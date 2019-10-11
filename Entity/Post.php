<?php
/**
 * Entity for Posts
 *
 * PHP Version 7.+
 *
 * @category  Entity
 * @package   Entity
 * @author    Sylvain SAEZ <saez.sylvain@gmail.com>
 * @copyright 2019 Frakdev
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      sylvainsaez.fr
 */

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;

/**
 * Entity for the posts used in the blog
 *
 * @category Entity
 * @package  Entity
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 *
 * @Entity @Table(name="post")
 **/
class Post
{
    /**
     * Unique id of the blogpost
     *
     * @var integer $id
     * @Id  @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * Title of the blogpost
     *
     * @var   string $title
     * @title @Column(type="string")
     */
    protected $title;

    /**
     * Excerpt of the blogpost
     *
     * @var   string $chapo
     * @chapo @Column(type="string")
     */
    protected $chapo;

    /**
     * Content of the blogpost
     *
     * @var     string $contentText
     * @content @Column(type="string")
     */
    protected $contentText;

    /**
     * Author of the blogpost
     *
     * @var    string $author
     * @author @Column(type="string")
     */
    protected $author;

    /**
     * Creation date of the blogpost
     *
     * @var           integer $date_creation
     * @date_creation @Column(type="integer")
     */
    protected $date_creation;

    /**
     * The unique route of the blogpost
     *
     * @var   string $route
     * @route @Column(type="string")
     */
    protected $route;

    /**
     * OneToMany(targetEntity="Comment", mappedBy="post", orphanRemoval="true")
     */
    private $comments;

    /**
     * Get the id of the blogpost
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the title of the blogpost
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the title of the blogpost
     *
     * @param string $title sentence
     *
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the excerpt of the blogpost
     *
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * Set the excerpt of the blogpost
     *
     * @param string $chapo excerpt of the blog post
     *
     * @return Post
     */
    public function setChapo(string $chapo): Post
    {
        $this->chapo = $chapo;
        return $this;
    }

    /**
     * Get the content of the blogpost
     *
     * @return string
     */
    public function getContentText(): string
    {
        return $this->contentText;
    }

    /**
     * Set the content of the blogpost
     *
     * @param string $contentText content of the blogpost
     *
     * @return Post
     */
    public function setContentText(string $contentText): Post
    {
        $this->contentText = $contentText;
        return $this;
    }

    /**
     * Get the author of the blogpost
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the author of the blogpost
     *
     * @param string $author name
     *
     * @return Post
     */
    public function setAuthor(string $author): Post
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get the date of creation of the blogpost
     *
     * @return int
     */
    public function getDateCreation(): int
    {
        return $this->date_creation;
    }

    /**
     * Set the date of craetion of the blogpost
     *
     * @param integer $date_creation timestamp
     *
     * @return Post
     */
    public function setDateCreation(int $date_creation): Post
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    /**
     * Get the route of the blogpost
     *
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * Set the route of the blogpost
     *
     * @param string $route unique
     *
     * @return Post
     */
    public function setRoute(string $route): Post
    {
        $this->route = $route;
        return $this;
    }

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }
}
