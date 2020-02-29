<?php

namespace Core\Database\DataTransferObject;

final class ConnectionRequest
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function validate($email, $password): array
    {
        $errors = [];

        if(empty($email)) {
            $errors['email'] = 'Invalid Email';
        }

        if(empty($password)) {
            $errors['password'] = 'Invalid Password';
        }

        return $errors;

    }
}