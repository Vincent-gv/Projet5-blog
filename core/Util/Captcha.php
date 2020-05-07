<?php


namespace Core\Util;

use Core\Config\ParameterManager;
use Core\Config\ParametersInterface;
use ReCaptcha\ReCaptcha;

abstract class Captcha
{
    static public function reCaptcha($reCaptchaResponse): string
    {
        $captchaSecretKey = ParameterManager::getParameter(ParametersInterface::KEY_CAPTCHA_SECRET_KEY);
        $reCaptcha = new ReCaptcha($captchaSecretKey[1]);
        $resp = $reCaptcha->verify(
            $reCaptchaResponse,
            $_SERVER["REMOTE_ADDR"]
        );
        if ($resp != null && $resp->isSuccess()) {
            return true;
        } else {
            return false;
        }
    }
}