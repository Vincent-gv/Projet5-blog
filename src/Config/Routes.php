<?php

namespace App\Config;

use Core\Router\Route;
use Core\Router\RoutesInterface;

abstract class Routes implements RoutesInterface
{
    /**
     * @return Route[]
     */
    public static function getRoutes(): array
    {
        return [
            new Route('/', 'Homepage'),
            new Route('/blog', 'Blog'),
            new Route('/contact', 'Contact'),
            new Route('/post', 'Post'),
            new Route('/poster', 'CreatePost'),
            new Route('/modifier', 'Update'),
            new Route('/commentaires', 'Moderate'),
            new Route('/utilisateur', 'User'),
            new Route('/admin', 'Admin'),
            new Route('/erreur', 'ErrorPage')
        ];
    }
}
