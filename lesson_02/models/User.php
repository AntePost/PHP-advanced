<?php

namespace App\models;

class User extends Model
{
    public $id;
    public $username;
    public $passwordHash;

    protected function getTableName()
    {
        return 'users';
    }

    public function setPasswordHash(string $password)
    {
        $this->passwordHash = password_hash($password, $algo = PASSWORD_DEFAULT);
    }
}