<?php

namespace Core\Config;

use Exception;

class ParameterException extends Exception
{
    public function __construct($key)
    {
        parent::__construct('Parameter \'' . $key . '\' not Found.');
    }
}