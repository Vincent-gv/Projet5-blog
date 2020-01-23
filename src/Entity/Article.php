<?php


namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;
use DateTime;

class Article extends AbstractEntity
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
     * @return Article
     */
    public function setId(?int $id): Article
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
     * @return Article
     */
    public function setTitle(?string $title): Article
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
     * @return Article
     */
    public function setChapo(?string $chapo): Article
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
     * @return Article
     */
    public function setContent(?string $content): Article
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
     * @return Article
     */
    public function setAuthor(?string $author): Article
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
     * @return Article
     */
    public function setCreatedAt(?DateTime $createdAt): Article
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}