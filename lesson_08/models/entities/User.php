<?php
namespace App\models\entities;

class User extends Entity
{
    public $id;
    public $username;
    public $passwordHash;
    public $isAdmin;

    public function setPasswordHash(string $password)
    {
        $this->passwordHash = password_hash($password, $algo = PASSWORD_DEFAULT);
    }
}
