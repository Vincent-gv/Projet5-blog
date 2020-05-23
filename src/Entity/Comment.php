<?php


namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;
use DateTime;

class Comment extends AbstractEntity
{
    public static function getTableInfos(): TableInfos
    {
        return new TableInfos('comments', [
            new ColumnInfos('id', ColumnInfos::STRING),
            new ColumnInfos('post_id', ColumnInfos::STRING),
            new ColumnInfos('username', ColumnInfos::STRING),
            new ColumnInfos('comment', ColumnInfos::STRING),
            new ColumnInfos('created_at', ColumnInfos::DATETIME),
            new ColumnInfos('status', ColumnInfos::STRING),
        ]);
    }

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $postId;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $comment;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var string
     */
    private $status;

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
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostId(): ?int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     * @return Comment
     */
    public function setPostId(?int $postId): Comment
    {
        $this->postId = $postId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Comment
     */
    public function setUsername(?string $username): Comment
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Comment
     */
    public function setComment(?string $comment): Comment
    {
        $this->comment = $comment;
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
     * @return Comment
     */
    public function setCreatedAt(?DateTime $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return Comment
     */
    public function setStatus(?string $status): Comment
    {
        $this->status = $status;
        return $this;
    }
}
