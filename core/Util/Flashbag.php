<?php

namespace Core\Util;

abstract class FlashBag
{
    public static function addFlash(string $message, string $type = 'info'): void
    {
        $_SESSION['flashbag'][$type][] = $message;
    }

    public static function getFlashs(): ?array
    {
        $flashbag = $_SESSION['flashbag'] ?? [];

        unset($_SESSION['flashbag']);

        return $flashbag;
    }
}
