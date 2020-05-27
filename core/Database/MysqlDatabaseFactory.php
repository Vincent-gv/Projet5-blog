<?php

namespace Core\Database;

use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;

abstract class MysqlDatabaseFactory
{
    public static function createMysqlDatabase(): DatabaseInterface
    {
        return new MysqlDatabase(
            ParameterManager::getParameter(ParametersInterface::KEY_DATABASE_DNS)->getValue(),
            ParameterManager::getParameter(ParametersInterface::KEY_DATABASE_USER)->getValue(),
            ParameterManager::getParameter(ParametersInterface::KEY_DATABASE_PASSWORD)->getValue()
        );
    }
}
