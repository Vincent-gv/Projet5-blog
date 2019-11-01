<?php


namespace App\Config;


use Core\Config\Parameter;
use Core\Config\ParametersInterface;

class Parameters implements ParametersInterface
{
    /**
     * @return Parameter[]
     */
    public function getParameters(): array
    {
        return [
            new Parameter(self::KEY_DATABASE_DNS, 'mysql:host=localhost;dbname=blog'),
            new Parameter(self::KEY_DATABASE_USER, 'root'),
            new Parameter(self::KEY_DATABASE_PASSWORD, ''),
        ];
    }
}