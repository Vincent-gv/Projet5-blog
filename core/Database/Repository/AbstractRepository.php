<?php


namespace Core\Database\Repository;


use Core\Database\DatabaseInterface;
use Core\Database\Entity\TableInfos;

abstract class AbstractRepository
{
    /**
     * @var DatabaseInterface
     */
    protected $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    protected function hydrate($datas)
    {
        if (is_object($datas)) {
            return $this->hydrateObj($datas);
        }

        return array_map([$this, 'hydrateObj'], $datas);
    }

    abstract protected function hydrateObj(object $object);

    abstract protected function getEntityClass(): string;

    protected function getEntityTableInfos(): TableInfos
    {
        return $this->getEntityClass()::getTableInfos();
    }

    public function findAll(): array
    {
        return $this->hydrate($this->database->query('SELECT * FROM ' . $this->getEntityTableInfos()->getName()));
    }

    public function find(string $id)
    {
        return $this->hydrate($this->database->query('SELECT * FROM ' . $this->getEntityTableInfos()->getName().' WHERE id=:id', [':id'=>$id], true));
    }
}