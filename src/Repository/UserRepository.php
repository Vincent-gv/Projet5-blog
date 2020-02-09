<?php

namespace App\Repository;

use App\Entity\User;

class UserRepository
{
    public function findUserByEmail(string $email): ?User
    {
        foreach ($this->database as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

}