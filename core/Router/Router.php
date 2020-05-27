<?php

namespace Core\Router;

use App\Config\Routes;
use App\Controller\ErrorPageController;
use Core\Exception\NotFoundException;
use Exception;

class Router
{
    public function run(string $url): void
    {
        $route = $this->getRouteByUrl($url);
        if ($route === null) {
            $this->runErrorController(new NotFoundException('route not found'));
            return;
        }
        $controllerFullName = 'App\\Controller\\' . $route->getControllerName() . 'Controller';
        if (!class_exists($controllerFullName)) {
            $this->runErrorController(new NotFoundException('controller class not found'));
            return;
        }
        $controller = new $controllerFullName();

        try {
            $controller();
        } catch (Exception $exception) {
            $this->runErrorController($exception);
            return;
        }
    }

    private function getRouteByUrl(string $url): ?Route
    {
        foreach (Routes::getRoutes() as $route) {
            if ($route->getUrl() === $url) {
                return $route;
            }
        }
        return null;
    }

    private function runErrorController(Exception $exception): void
    {
        $controller = new ErrorPageController();
        $controller($exception);
    }
}
