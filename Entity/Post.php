<?php

namespace Entity;

/**
 * @Entity @Table(name="post")
 **/
class Post
{
    /**
     * @var integer $id
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @var string $title
     * @title @Column(type="string")
     */
    protected $title;

    /**
     * @var string $chapo
     * @chapo @Column(type="string")
     */
    protected $chapo;

    /**
     * @var string $contentText
     * @content @Column(type="string")
     */
    protected $contentText;

    /**
     * @var string $author
     * @author @Column(type="string")
     */
    protected $author;

    /**
     * @var integer $date_creation
     * @date_creation @Column(type="integer")
     */
    protected $date_creation;

    /**
     * @var string $route
     * @route @Column(type="string")
     */
    protected $route;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * @param string $chapo
     * @return Post
     */
    public function setChapo(string $chapo): Post
    {
        $this->chapo = $chapo;
        return $this;
    }

    /**
     * @return string
     */
    public function getContentText(): string
    {
        return $this->contentText;
    }

    /**
     * @param string $contentText
     * @return Post
     */
    public function setContentText(string $contentText): Post
    {
        $this->contentText = $contentText;
        return $this;
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
     * @return Post
     */
    public function setAuthor(string $author): Post
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return int
     */
    public function getDateCreation(): int
    {
        return $this->date_creation;
    }

    /**
     * @param integer $date_creation
     * @return Post
     */
    public function setDateCreation(int $date_creation): Post
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return Post
     */
    public function setRoute(string $route): Post
    {
        $this->route = $route;
        return $this;
    }

}