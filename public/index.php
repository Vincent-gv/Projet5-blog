<?php
require '../vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use Core\Router\Router;
use Core\Util\FlashBag;

session_start();

(new Router())->run($_SERVER['REDIRECT_URL'] ?? '/');

FlashBag::addFlash('info');
FlashBag::addFlash('error', 'danger');
FlashBag::addFlash('success', 'success');

// header('Location: result.php');