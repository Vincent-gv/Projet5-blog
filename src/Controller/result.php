<?php


use Twig\TwigFunction;
use Core\Util\FlashBag;
//
//require_once '../vendor/autoload.php';

session_start();

$flashbag = new TwigFunction('flashbag', function ()
{
    return FlashBag::getFlashs();
});
$twig->addFunction($flashbag);


echo $twig->render('default.html.twig', []);

