<?php
require '../vendor/autoload.php';
// var_dump($_SERVER);
use Core\Router\Router;
(new Router())->run($_SERVER['REDIRECT_URL'] ?? '/');
