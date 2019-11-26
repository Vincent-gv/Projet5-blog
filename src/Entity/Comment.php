<?php


namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;

class Comment extends AbstractEntity
{
    static public function getTableInfos(): TableInfos
    {
        return new TableInfos('comments', [
            new ColumnInfos('id', ColumnInfos::STRING),
            new ColumnInfos('id_post', ColumnInfos::STRING),
            new ColumnInfos('id_user', ColumnInfos::STRING),
            new ColumnInfos('comment', ColumnInfos::STRING),
            new ColumnInfos('created_at', ColumnInfos::STRING),
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
     * @var int
     */
    private $idUser;
    /**
     * @var string
     */
    private $comment;
    /**
     * @var string
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
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }
    /**
     * @param int $idUser
     * @return Comment
     */
    public function setIdUser(int $idUser): Comment
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getcomment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Comment
     */
    public function setcomment(string $comment): Comment
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return string
     *
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Comment
     */
    public function setCreatedAt(string $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}