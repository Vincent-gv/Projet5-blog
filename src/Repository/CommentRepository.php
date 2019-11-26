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
            ->setIdPost($obj->id_post)
//          ->setIdUser($obj->id_user)
            ->setComment($obj->comment)
            ->setCreatedAt($obj->created_at);
    }

    public function save($comment)
    {
        // ici on sauvegqrde en db
    }


}