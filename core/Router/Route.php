<?php


namespace Core\Router;


class Route
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $controllerName;
    /**
     * @var string
     */
    private $actionName;

    public function __construct(string $url, string $controllerName, string $actionName)
    {
        $this->url = $url;
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Route
     */
    public function setUrl(string $url): Route
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     * @return Route
     */
    public function setControllerName(string $controllerName): Route
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     * @return Route
     */
    public function setActionName(string $actionName): Route
    {
        $this->actionName = $actionName;
        return $this;
    }

}