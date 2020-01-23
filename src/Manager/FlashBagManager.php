<?php

namespace App\Manager;

use App\DataTransferObject\FlashMessage;

class FlashBagManager
{
    public function addFlashMessage(FlashMessage $flashMessage): void
    {
        $_SESSION['flashBag'][] = $flashMessage;
    }

    public function getFlashBag (): array
    {
        $flashBag = $_SESSION['flashBag'];
        $_SESSION['flashBag'] = [];
        return $flashBag;
    }
}