<?php

namespace App\Repository;

use App\Entity\Post;
use Core\Database\Repository\AbstractRepository;
use DateTime;

class PostRepository extends AbstractRepository
{
    protected function getEntityClass(): string
    {
        return Post::class;
    }

    protected function hydrateObj(object $obj)
    {
        return (new Post())
            ->setId($obj->id)
            ->setTitle($obj->title)
            ->setChapo($obj->chapo)
            ->setContent($obj->content)
            ->setAuthor($obj->author)
            ->setCreatedAt(new \DateTime($obj->created_at));
    }

    public function latestPosts()
    {
        return $this->hydrate($this->database->query('SELECT * FROM post ORDER BY id DESC LIMIT 3'));
    }

    public function createPost(Post $article)
    {
        $sql = "INSERT INTO post (title, chapo, content, author, created_at)
 VALUES (:title, :chapo, :content, :author, :created_at)";
        return $this->database->execute($sql, [
            'title' => $article->getTitle(),
            'chapo' => $article->getChapo(),
            'content' => $article->getContent(),
            'author' => $article->getAuthor(),
            'created_at' => $article->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM `post` WHERE id=:id;";
        return $this->database->execute($sql, [
            'id' => $id
        ]);
    }

    public function updatePost(Post $article)
    {
        $id = $_GET['id'];
        $sql = "UPDATE post SET title=:title, chapo=:chapo, content=:content, author=:author, created_at=:created_at
 WHERE id=:id";
        return $this->database->execute($sql, [
            'id' => $id,
            'title' => $article->getTitle(),
            'chapo' => $article->getChapo(),
            'content' => $article->getContent(),
            'author' => $article->getAuthor(),
            'created_at' => $article->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }
}