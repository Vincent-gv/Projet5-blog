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

    public function comments()
    {
        $sql = "SELECT comments.*, post.title FROM comments 
	LEFT JOIN post ON comments.post_id = post.id;";
        return $this->database->query($sql, [
        ]);
    }

    public function countPostComments($id)
    {
        return $this->countBy(['post_id' => $id]);
    }

    protected function hydrateObj(object $obj)
    {
        return (new Comment())
            ->setId($obj->id)
            ->setPostId($obj->post_id)
            ->setUsername($obj->username)
            ->setComment($obj->comment)
            ->setCreatedAt(new DateTime($obj->created_at))
            ->setStatus($obj->status);
    }

    public function create(Comment $comment)
    {
        $sql = "INSERT INTO comments (post_id, username, comment, created_at, status)
 VALUES (:post_id, :username, :comment, :created_at, :status)";
        $this->database->execute($sql, [
            'post_id' => $comment->getPostId(),
            'username' => $comment->getUsername(),
            'comment' => $comment->getComment(),
            'created_at' => $comment->getCreatedAt()->format('d/m/y H:i:s'),
            'status' => $comment->getStatus()
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM comments WHERE id=:id";
        return $this->database->execute($sql, [
            'id' => $id
        ]);
    }

    public function publish($id)
    {
        $status = 1;
        $sql = "UPDATE comments SET status=:status WHERE id=:id";
        return $this->database->execute($sql, [
            'status' => $status,
            'id' => $id
        ]);
    }

}