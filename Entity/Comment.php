<?php
/**
 * Entity for Comments
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

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * Entity for the comments used in the blog
 *
 * @category Entity
 * @package  Entity
 * @author   Sylvain SAEZ <saez.sylvain@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     sylvainsaez.fr
 *
 * @Entity @Table(name="comment")
 **/
class Comment
{
    /**
     * The unique id of the comment
     *
     * @var integer $id
     * @Id  @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * The user wha have post the comment
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id",     referencedColumnName="id")
     */
    protected $user;

    /**
     * The content of the comment
     *
     * @var                   string $message
     * @Column(type="string")
     */
    protected $message;

    /**
     * The status of the comment after being post
     *
     * @var                    boolean $checked
     * @Column(type="boolean", options={"default":"0"})
     */
    protected $checked = false;

    /**
     * The time when the comment have been post
     *
     * @var                    integer $postdate
     * @Column(type="integer")
     */
    protected $postdate;

    /**
     * The post where the comment have been post
     *
     * @ManyToOne(targetEntity="Post")
     * @JoinColumn(name="post_id",     referencedColumnName="id", onDelete="CASCADE")
     */
    protected $post;

    /**
     * Get the id of the comment
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



    /**
     * Get the message of the comment
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set the message of the comment
     *
     * @param string $message content of the comment
     *
     * @return Comment
     */
    public function setMessage(string $message): Comment
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get the postdate of the comment
     *
     * @return int
     */
    public function getPostdate(): int
    {
        return $this->postdate;
    }

    /**
     * Set the postdate of the comment
     *
     * @param int $postdate timestamp
     *
     * @return Comment
     */
    public function setPostdate(int $postdate): Comment
    {
        $this->postdate = $postdate;
        return $this;
    }

    /**
     * Get the status of the comment
     *
     * @return int
     */
    public function getChecked(): int
    {
        return $this->checked;
    }

    /**
     * Set the status of the comment
     *
     * @param int $checked boolean for the status
     *
     * @return Comment
     */
    public function setChecked(int $checked): Comment
    {
        $this->checked = $checked;
        return $this;
    }

    /**
     * Get the post where the comment has been post
     *
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set the post in wich the comment has been post
     *
     * @param mixed $post the post where the comment is
     *
     * @return Comment
     */
    public function setPost($post): Comment
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return Comment
     */
    public function setUser($user): Comment
    {
        $this->user = $user;
        return $this;
    }
}
