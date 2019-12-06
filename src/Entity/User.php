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
            new ColumnInfos('password', ColumnInfos::STRING),
            new ColumnInfos('email', ColumnInfos::STRING),
            new ColumnInfos('created_at', ColumnInfos::STRING),
        ]);
    }

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $username;
    /**
     * @var int
     */
    private $password;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @param int $id
     * @return Comment
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUsername(): int
    {
        return $this->username;
    }
    /**
     * @param string $username
     * @return User
     */
    public function setUsername(int $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return int
     */
    public function getPassword(): int
    {
        return $this->password;
    }
    /**
     * @param int $password
     * @return User
     */
    public function setPassword(int $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     *
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return User
     */
    public function setCreatedAt(string $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}