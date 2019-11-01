<?php


namespace Core\Router;


use App\Config\Routes;

class Router
{
    public function run(string $url): void
    {
        $route = $this->getRouteByUrl($url);

        if ($route === null) {
            die ('404 not found');
        }

        $controllerFullName = 'App\\Controller\\' . $route->getControllerName() . 'Controller';

        if (!class_exists($controllerFullName)) {
            die ('Class ' . $controllerFullName . ' doesn\'t exist');
        }
        $controller = new $controllerFullName();

        $actionName = $route->getActionName() . 'Action';

        if (!method_exists($controller, $actionName)) {
            die ('Method ' . $actionName . ' doesn\'t exist in Class ' . $controllerFullName);
        }
        $controller->$actionName();
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
}