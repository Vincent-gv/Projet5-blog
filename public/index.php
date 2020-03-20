<?php

require '../vendor/autoload.php';

use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;
use Core\Router\Router;

if (ParameterManager::getParameter(ParametersInterface::KEY_IS_DEBUG)->getValue()) {
    $whoops = new \Whoops\Run;
    $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}
else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
session_start();

(new Router())->run(explode('?',$_SERVER['REQUEST_URI'])[0] ?? '/');