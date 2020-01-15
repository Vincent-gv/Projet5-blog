<?php


namespace App\Config;


use Core\Router\Route;
use Core\Router\RoutesInterface;

abstract class Routes implements RoutesInterface
{
    /**
     * @return Route[]
     */
    static public function getRoutes(): array
    {
        return [
            new Route('/', 'Default', 'homepage'),
            new Route('/contact', 'Default', 'contact'),
            new Route('/blog', 'Default', 'blog'),
            new Route('/post', 'Default', 'post'),
            new Route('/enregistrement', 'Default', 'enregistrement'),
            new Route('/ajouter-article', 'Default', 'ajouterArticle')
        ];
    }
}