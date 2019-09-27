<?php
require '../vendor/autoload.php';

use Core\Router\Router;

(new Router())->run($_SERVER['REQUEST_URI'] ?? '/');