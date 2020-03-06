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
            new Route('/post', 'Default', 'article'),
            new Route('/poster', 'Default', 'post'),
            new Route('/modifier', 'Default', 'update'),
            new Route('/commentaires', 'Default', 'moderate'),
            new Route('/utilisateur', 'User', 'user'),
            new Route('/admin', 'Connect', 'connect')
        ];
    }
}