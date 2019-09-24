<?php


namespace Entity;

/**
 * @Entity @Table(name="comment")
 **/
class Comments
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
     * @return Comments
     */
    public function setAuthor(string $author): Comments
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
     * @return Comments
     */
    public function setMessage(string $message): Comments
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
     * @return Comments
     */
    public function setPostdate(int $postdate): Comments
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
     * @return Comments
     */
    public function setChecked(int $checked): Comments
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
     * @return Comments
     */
    public function setPostId(int $postId): Comments
    {
        $this->postId = $postId;
        return $this;
    }
}