<?php

namespace Core\Config;

interface ParametersInterface
{
    const KEY_DATABASE_DNS = 'database_dns';
    const KEY_DATABASE_USER = 'database_user';
    const KEY_DATABASE_PASSWORD = 'database_password';
    const KEY_IS_DEBUG = 'is_debug';

    /**
     * @return Parameter[]
     */
    public function getParameters(): array;
}