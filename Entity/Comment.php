<?php


namespace Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @Entity @Table(name="comment")
 **/
class Comment
{
    /**
     * @var integer $id
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string $author
     * @Column(type="string")
     */
    protected $author;

    /**
     * @var string $message
     * @Column(type="string")
     */
    protected $message;

    /**
     * @var integer $checked
     * @Column(type="integer")
     */
    protected $checked;

    /**
     * @var integer $postdate
     * @Column(type="integer")
     */
    protected $postdate;

    /**
     * @ManyToOne(targetEntity="Post")
     * @JoinColumn(name="post_id", referencedColumnName="id")
     */
    protected $post;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Comment
     */
    public function setAuthor(string $author): Comment
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Comment
     */
    public function setMessage(string $message): Comment
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostdate(): int
    {
        return $this->postdate;
    }

    /**
     * @param int $postdate
     * @return Comment
     */
    public function setPostdate(int $postdate): Comment
    {
        $this->postdate = $postdate;
        return $this;
    }

    /**
     * @return int
     */
    public function getChecked(): int
    {
        return $this->checked;
    }

    /**
     * @param int $checked
     * @return Comment
     */
    public function setChecked(int $checked): Comment
    {
        $this->checked = $checked;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post): Comment
    {
        $this->post = $post;
        return $this;
    }
}
