<?php

require_once '../vendor/autoload.php';

use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;
use Core\Router\Router;

try {
    if (ParameterManager::getParameter(ParametersInterface::KEY_IS_DEBUG)->getValue()) {
        $whoops = new \Whoops\Run;
        $whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }
} catch (\Core\Config\ParameterException $e) {
}

session_start();

(new Router())->run(explode('?', $_SERVER['REQUEST_URI'])[0] ?? '/');
