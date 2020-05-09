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
            new Parameter(self::KEY_IS_DEBUG, true),
            new Parameter(self::KEY_EMAIL_CONTACT, 'vinzmass@gmail.com'),
            new Parameter( self::KEY_CAPTCHA_PUBLIC_KEY, '6Leh4-kUAAAAAOspZuwp7wj1a0xAnqD9YKYCN-eA'),
            new Parameter( self::KEY_CAPTCHA_SECRET_KEY, '6Leh4-kUAAAAAJOHUwnl6_p9KkyG8qCtdIYKY7NR'),
            new Parameter( self::KEY_GOOGLE_MAP, 'AIzaSyCPo0NaEvefJ4N6U1WfCLqxuvhX_Fnl4gc')
        ];
    }
}