<?php

namespace Core\Exception;

use Throwable;

class AuthenticationException extends \Exception
{
    private $customMessage;

    public function __construct($customMessage, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->customMessage = $customMessage;
    }

    /**
     * @return mixed
     */
    public function getCustomMessage()
    {
        return $this->customMessage;
    }
}