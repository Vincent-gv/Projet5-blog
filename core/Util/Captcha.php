<?php


namespace Core\Util;

use ReCaptcha\ReCaptcha;

abstract class Captcha
{
    static public function reCaptcha($reCaptchaResponse): string
    {
        $reCaptcha = new ReCaptcha('6Leh4-kUAAAAAJOHUwnl6_p9KkyG8qCtdIYKY7NR');
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