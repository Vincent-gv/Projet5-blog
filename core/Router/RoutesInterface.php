<?php

namespace Core\Router;

interface RoutesInterface
{
    /**
     * @return Route[]
     */
    public static function getRoutes(): array;
}
