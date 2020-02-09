<?php

use Core\Exception\AuthenticationException;
use Core\Util\Authentication;
require_once '../vendor/autoload.php';

session_start();

try {
    Authentication::connect('toto@openclassrooms.com', 'toto');
    FlashBag::addFlash('Connexion réussi', 'success');
    header('Location: /');
    die();
} catch (AuthenticationException $exception) {
    FlashBag::addFlash($exception->getCustomMessage(), 'danger');
    header('Location: /');
    die();
}
