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
            ->setPostId($obj->post_id)
            ->setUsername($obj->username)
            ->setComment($obj->comment)
            ->setCreatedAt(new DateTime($obj->created_at));
    }

    public function create(Comment $comment)
    {
        $sql = "INSERT INTO comments (post_id, username, comment, created_at)
 VALUES (:post_id, :username, :comment, :created_at)";
        $this->database->execute($sql, [
            'post_id' => $comment->getPostId(),
            'username' => $comment->getUsername(),
            'comment' => $comment->getComment(),
            'created_at' => $comment->getCreatedAt()->format('d/m/y H:i:s')
        ]);
    }
}