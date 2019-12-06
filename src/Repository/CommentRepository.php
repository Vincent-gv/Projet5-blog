<?php


namespace App\Repository;


use App\Entity\Comment;
use Core\Database\Repository\AbstractRepository;
use DateTime;

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
            ->setUsername($obj->id_user)
            ->setComment($obj->comment)
            ->setCreatedAt(new DateTime($obj->created_at));
    }

    public function insertComment(Comment $comment)
    {
        $sql = "INSERT INTO table (id_post, username, comment, created_at)
 VALUES (:id_post, :username, :comment, :created_at)";
        $this->database->query($sql, [
            'id_post'=>$comment->getIdPost(),
        'username'=>$comment->getUsername(),
            'comment'=>$comment->getComment(),
            'created_at'=>$comment->getCreatedAt()
        ]);
    }
}