<?php

use Core\Exception\AuthenticationException;
use Core\Util\Authentication;
use Core\Util\FlashBag;

require_once '../vendor/autoload.php';

session_start();

Authentication::disconnect();
FlashBag::addFlash('Déconnexion réussi', 'success');
header('Location: /');
die();