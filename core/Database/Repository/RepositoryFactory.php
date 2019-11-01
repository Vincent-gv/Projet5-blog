<?php


namespace Core\Database\Repository;


use Core\Database\MysqlDatabaseFactory;

abstract class RepositoryFactory
{
    static public function createRepository(string $entityClass): AbstractRepository
    {
        $repositoryClass = self::getRepositoryClass($entityClass);

        if (!class_exists($repositoryClass)) {
            throw new RepositoryException('Repository \'' . $repositoryClass . '\' doesn\'t exist.');
        }

        $repository = new $repositoryClass(
            MysqlDatabaseFactory::createMysqlDatabase()
        );

        if (!($repository instanceof AbstractRepository)) {
            throw new RepositoryException('Repository \'' . $repositoryClass . '\' doesn\'t extends \'' . AbstractRepository::class . '\'.');
        }

        return $repository;
    }

    /**
     * Transforme le namespace d'une entité en son repository
     * Ex : App/Entity/Post => App/Repository/PostRepository
     *
     * @param string $entityClass
     * @return string
     */
    static private function getRepositoryClass(string $entityClass)
    {
        return str_replace('Entity', 'Repository', $entityClass) . 'Repository';

    }
}