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
            ->setContent($obj->content)
            ->setCreatedAt(new \DateTime($obj->created_at));
    }

    public function create(Article $article)
    {
        $sql = "INSERT INTO post (title, content, created_at)
 VALUES (:title, :content, :created_at)";
        $this->database->execute($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'created_at' => $article->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }
}