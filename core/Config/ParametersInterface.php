<?php


namespace Core\Config;


interface ParametersInterface
{
    const KEY_DATABASE_DNS = 'database_dns';
    const KEY_DATABASE_USER = 'database_user';
    const KEY_DATABASE_PASSWORD = 'database_password';

    /**
     * @return Parameter[]
     */
    public function getParameters(): array;
}