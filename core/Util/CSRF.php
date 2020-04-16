<?php


namespace Core\Util;


abstract class CSRF
{
    static public function generateToken(): string
    {
        $token = md5(uniqid());
        $_SESSION['csrf'] = [
            'token' => $token,
            'createdAt' => new \DateTime()
        ];

        return $token;
    }

    static private function getCsrfToken(): string
    {
        return $_SESSION['csrf']['token'];
    }

    static private function getCsrfCreatedAt(): \DateTime
    {
        return $_SESSION['csrf']['createdAt'];
    }

    static public function checkToken(string $token): bool
    {
        if ($token !== self::getCsrfToken()) {
            return false;
        }

        $expireAt = self::getCsrfCreatedAt()->add(new \DateInterval('PT10M'));

        if ($expireAt < new \DateTime()) {
            return false;
        }

        return true;
    }

}