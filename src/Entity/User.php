<?php

namespace App\Entity;

use Core\Database\Entity\AbstractEntity;
use Core\Database\Entity\ColumnInfos;
use Core\Database\Entity\TableInfos;

class User extends AbstractEntity
{
    static public function getTableInfos(): TableInfos
    {
        return new TableInfos('users', [
            new ColumnInfos('id', ColumnInfos::STRING),
            new ColumnInfos('username', ColumnInfos::STRING),
            new ColumnInfos('email', ColumnInfos::STRING),
            new ColumnInfos('password', ColumnInfos::STRING),
        ]);
    }

    private $id;

    public $username;

    public $email;

    private $password;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}