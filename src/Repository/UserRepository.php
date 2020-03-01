<?php

namespace App\Repository;

use App\Entity\User;
use Core\Database\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{

    protected function getEntityClass(): string
    {
        return User::class;
    }
//
//    public function disconnect()
//    {
//        unset($_SESSION['userConnected']);
//    }
//
//    public function isConnected(): bool
//    {
//        return self::getUserConnected() !== null;
//    }
//
    public function getUserConnected(): ?User
    {
        return $_SESSION['userConnected'] ?? null;
    }

    public function findByEmail($email): ?User
    {
        return $this->findBy(['email' => $email])[0] ?? null;
    }

    protected function hydrateObj(object $object): User
    {
        return (new User())
            ->setId($object->id)
            ->setUsername($object->username)
            ->setEmail($object->email)
            ->setPassword($object->password);
    }
}