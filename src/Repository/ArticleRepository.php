<?php

namespace App\Repository;

use App\Entity\Article;
use Core\Database\Repository\AbstractRepository;
use DateTime;

class ArticleRepository extends AbstractRepository
{
    protected function getEntityClass(): string
    {
        return Article::class;
    }

    protected function hydrateObj(object $obj)
    {
        return (new Article())
            ->setId($obj->id)
            ->setTitle($obj->title)
            ->setChapo($obj->chapo)
            ->setContent($obj->content)
            ->setAuthor($obj->author)
            ->setCreatedAt(new \DateTime($obj->created_at));
    }

    public function create(Article $article)
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
}