<?php


namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;
use DateTime;

class Comment extends AbstractEntity
{
    static public function getTableInfos(): TableInfos
    {
        return new TableInfos('comments', [
            new ColumnInfos('id', ColumnInfos::STRING),
            new ColumnInfos('id_post', ColumnInfos::STRING),
            new ColumnInfos('username', ColumnInfos::STRING),
            new ColumnInfos('comment', ColumnInfos::STRING),
            new ColumnInfos('created_at', ColumnInfos::DATETIME),
        ]);
    }

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $idPost;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return Comment
     */
    public function setId(int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdPost(): int
    {
        return $this->idPost;
    }
    /**
     * @param int $idPost
     * @return Comment
     */
    public function setIdPost(int $idPost): Comment
    {
        $this->idPost = $idPost;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    /**
     * @param string $username
     * @return Comment
     */
    public function setUsername(string $username): Comment
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Comment
     */
    public function setComment(string $comment): Comment
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return DateTime
     *
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Comment
     */
    public function setCreatedAt(DateTime $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}