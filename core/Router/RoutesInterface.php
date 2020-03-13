<?php

namespace Core\Router;

interface RoutesInterface
{
    /**
     * @return Route[]
     */
    static public function getRoutes(): array;
}