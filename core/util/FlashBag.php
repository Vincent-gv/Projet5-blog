<?php


namespace Core\util;


abstract class FlashBag
{
    static public function addFlash(string $message, string $type = 'info'): void
    {
        $_SESSION['flashbag'][$type][] = $message;
    }

    static public function getFlashs(): ?array
    {
        $flashbag = $_SESSION['flashbag'] ?? [];

        unset($_SESSION['flashbag']);

        return $flashbag;
    }
}