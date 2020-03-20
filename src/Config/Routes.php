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
            new Route('/', 'Homepage', 'homepage'),
            new Route('/blog', 'Blog', 'blog'),
            new Route('/contact', 'Contact', 'contact'),
            new Route('/post', 'Article', 'article'),
            new Route('/poster', 'Post', 'post'),
            new Route('/modifier', 'Update', 'update'),
            new Route('/commentaires', 'Moderate', 'moderate'),
            new Route('/utilisateur', 'User', 'user'),
            new Route('/admin', 'Connect', 'connect')
        ];
    }
}