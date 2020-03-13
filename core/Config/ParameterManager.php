<?php

namespace Core\Config;

use App\Config\Parameters;

abstract class ParameterManager
{
    static public function getParameter($key)
    {
        $parameters = new Parameters();
        foreach ($parameters->getParameters() as $parameter) {
            if ($parameter->getKey() === $key) {
                return $parameter;
            }
        }
        throw new ParameterException($key);
    }
}