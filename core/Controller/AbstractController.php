<?php


namespace Core\Controller;

use Core\Database\Repository\AbstractRepository;
use Core\Database\Repository\RepositoryFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    public function getRepository(string $entity): AbstractRepository
    {
        return RepositoryFactory::createRepository($entity);
    }

    public function render(string $name, array $context = [])
    {
        $loader = new FilesystemLoader('../templates');
        $twig = new Environment($loader, [
            'strict_variables' => true
        ]);

        echo $twig->render($name, $context);

    }

    public function redirect (string $url) {
        header('Location: '.$url);
        die();
    }


}