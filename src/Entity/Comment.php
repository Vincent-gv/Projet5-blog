<?php


namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;

class Comment extends AbstractEntity
{
    static public function getTableInfos(): TableInfos
    {
        return new TableInfos('commentaires', [
            new ColumnInfos('id', ColumnInfos::STRING),
            new ColumnInfos('id-post', ColumnInfos::STRING),
            new ColumnInfos('id-auteur', ColumnInfos::STRING),
            new ColumnInfos('commentaire', ColumnInfos::STRING),
            new ColumnInfos('creation_date', ColumnInfos::STRING),
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
    private $idAuteur;
    /**
     * @var string
     */
    private $commentaire;
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
        return $this->id;
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
    public function getIdAuteur(): int
    {
        return $this->id;
    }
    /**
     * @param int $idAuteur
     * @return Comment
     */
    public function setIdAuteur(int $idAuteur): Comment
    {
        $this->idAuteur = $idAuteur;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommentaire(): string
    {
        return $this->Commentaire;
    }

    /**
     * @param string $Commentaire
     * @return Comment
     */
    public function setCommentaire(string $commentaire): Comment
    {
        $this->commentaire = $commentaire;
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