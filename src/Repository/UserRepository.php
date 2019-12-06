<?php


namespace App\Repository;


use App\Entity\Comment;
use Core\Database\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    protected function getEntityClass(): string
    {
        return User::class;
    }

    protected function hydrateObj(object $obj)
    {
        return (new User())
            ->setId($obj->id)
            ->setUsername($obj->username)
            ->setPassword($obj->password)
            ->setEmail($obj->email)
            ->setCreatedAt($obj->created_at);
    }

    public function save($user)
    {
        // ici on sauvegqrde en db
    }


}