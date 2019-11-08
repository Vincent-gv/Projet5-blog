<?php


namespace App\Repository;


use App\Entity\Comment;
use Core\Database\Repository\AbstractRepository;

class CommentRepository extends AbstractRepository
{
    protected function getEntityClass(): string
    {
        return Comment::class;
    }

    protected function hydrateObj(object $obj)
    {
        return (new Comment())
            ->setId($obj->id)
            ->setIdPost($obj->idPost)
            ->setIdAuteur($obj->idAuteur)
            ->setCommentaire($obj->commentaire)
            ->setCreatedAt(new \DateTime($obj->creation_date));
    }
}