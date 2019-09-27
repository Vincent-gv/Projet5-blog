<?php


namespace App\Repository;


use App\Entity\Post;
use Core\Database\Repository\AbstractRepository;

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
            ->setContent($obj->content)
            ->setCreatedAt(new \DateTime($obj->creation_date));
    }

    public function find10()
    {
        return $this->hydrate($this->database->query('SELECT * FROM post LIMIT 10'));
    }
}