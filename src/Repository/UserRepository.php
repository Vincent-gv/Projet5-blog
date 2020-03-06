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

    protected function hydrateObj(object $object): User
    {
        return (new User())
            ->setId($object->id)
            ->setUsername($object->username)
            ->setEmail($object->email)
            ->setPassword($object->password);
    }

    public function findByEmail($email): ?User
    {
        return $this->findBy(['email' => $email])[0] ?? null;
    }

    public function createUser(User $user)
    {
        $sql = "INSERT INTO users (username, email, password)
 VALUES (:username, :email, :password)";
        return $this->database->execute($sql, [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
        ]);
    }
}