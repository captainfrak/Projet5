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
     * @title @Column(type="string")
     */
    protected $author;

    /**
     * @var string $message
     * @title @Column(type="string")
     */
    protected $message;

    /**
     * @var integer $postdate
     * @title @Column(type="integer")
     */
    protected $postdate;

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
    }
}