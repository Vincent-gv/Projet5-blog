<?php


namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;
use DateTime;

class Post extends AbstractEntity
{
    static public function getTableInfos(): TableInfos
    {
        return new TableInfos('post', [
            new ColumnInfos('id', ColumnInfos::STRING),
            new ColumnInfos('title', ColumnInfos::STRING),
            new ColumnInfos('chapo', ColumnInfos::STRING),
            new ColumnInfos('content', ColumnInfos::STRING),
            new ColumnInfos('author', ColumnInfos::STRING),
            new ColumnInfos('created_at', ColumnInfos::DATETIME),
        ]);
    }

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $chapo;

    /**
     * @var string
     */
    private $content;
    /**
     * @var string
     */
    private $author;

    /**
     * @var DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->setCreatedAt(new DateTime());
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function setId(?int $id): Post
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(?string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getChapo(): ?string
    {
        return $this->chapo;
    }

    /**
     * @param string $chapo
     * @return Post
     */
    public function setChapo(?string $chapo): Post
    {
        $this->chapo = $chapo;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(?string $content): Post
    {
        $this->content = $content;
        return $this;
    }
   /**
     * @return string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Post
     */
    public function setAuthor(?string $author): Post
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return DateTime
     *
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt(?DateTime $createdAt): Post
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}