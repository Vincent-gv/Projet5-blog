<?php
require '../vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use Core\Router\Router;

session_start();

(new Router())->run($_SERVER['REDIRECT_URL'] ?? '/');