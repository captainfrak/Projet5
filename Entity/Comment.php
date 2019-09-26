<?php


namespace Entity;

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
     * @author @Column(type="string")
     */
    protected $author;

    /**
     * @var string $message
     * @message @Column(type="string")
     */
    protected $message;

    /**
     * @var integer $checked
     * @check @Column(type="integer")
     */
    protected $checked;

    /**
     * @var integer $postdate
     * @postdate @Column(type="integer")
     */
    protected $postdate;

    /**
     * @var integer $postId
     * @postId @Column(type="integer")
     */
    protected $postId;

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
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     * @return Comment
     */
    public function setPostId(int $postId): Comment
    {
        $this->postId = $postId;
        return $this;
    }
}