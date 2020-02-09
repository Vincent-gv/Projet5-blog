<?php

namespace Core\Util;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\Exception\AuthenticationException;

abstract class Authentication
{

    static public function connect(string $email, string $password)
    {
        $userRepository = new UserRepository();

        $user = $userRepository->findUserByEmail($email);

        if ($user === null) {
            throw new AuthenticationException('L\'utilisateur n\'existe pas');
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new AuthenticationException('Mot de passe incorrect');
        }

        $_SESSION['userConnected'] = $user;
    }

    static public function disconnect()
    {
        unset($_SESSION['userConnected']);
    }

    static public function isConnected(): bool
    {
        return self::getUserConnected() !== null;
    }

    static public function getUserConnected(): ?User
    {
        return $_SESSION['userConnected'] ?? null;
    }
}