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
            new Parameter(self::KEY_DATABASE_DNS, 'mysql:host=localhost;dbname=blog'), // your db host and db name
            new Parameter(self::KEY_DATABASE_USER, ''), // your db username
            new Parameter(self::KEY_DATABASE_PASSWORD, ''), // your db password
            new Parameter(self::KEY_IS_DEBUG, false), // indicate true to display errors
            new Parameter(self::KEY_EMAIL_CONTACT, 'your email'), // your email,
            new Parameter( self::KEY_CAPTCHA_PUBLIC_KEY, 'your Captcha public key'), // your captcha public key
            new Parameter( self::KEY_CAPTCHA_SECRET_KEY, 'your Captcha secret key'), // your captcha secret key
            new Parameter( self::KEY_GOOGLE_MAP, 'your Google Map key') // your google map key
        ];
    }
}
