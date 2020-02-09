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

// SELECT * FROM `post` p
//LEFT JOIN `comments` c ON p.id = c.post_id

// SELECT p.id, p.chapo, p.content, p.author, p.created_at, COUNT(c.id) AS nbComments FROM `post` p
//LEFT JOIN `comments` c ON p.id = c.post_id
//GROUP BY p.id, p.chapo, p.content, p.author, p.created_at

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

    public function create(Post $article)
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

    public function update(Post $article)
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