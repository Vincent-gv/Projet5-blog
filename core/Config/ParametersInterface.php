<?php

namespace Core\Config;

interface ParametersInterface
{
    const KEY_DATABASE_DNS = 'database_dns';
    const KEY_DATABASE_USER = 'database_user';
    const KEY_DATABASE_PASSWORD = 'database_password';
    const KEY_IS_DEBUG = 'is_debug';
    const KEY_EMAIL_CONTACT = 'email_contact';
    const KEY_CAPTCHA_PUBLIC_KEY = 'captcha_public_key';
    const KEY_CAPTCHA_SECRET_KEY = 'captcha_secret_key';
    const KEY_GOOGLE_MAP = 'google_map_key';

    /**
     * @return Parameter[]
     */
    public function getParameters(): array;
}
