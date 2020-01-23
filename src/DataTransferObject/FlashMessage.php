<?php

namespace App\DataTransferObject;

class FlashMessage
{
    private $message;

    private $type;

    public function __construct(string $message, string $type)
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getType(): string
    {
        return $this->type;
    }

}