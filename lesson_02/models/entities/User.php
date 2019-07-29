<?php
namespace App\models\entities;

/**
 * Class User
 * @package App\models\entities
 */
class User extends Entity
{
    public $id;
    public $username;
    public $passwordHash;

    public function setPasswordHash(string $password)
    {
        $this->passwordHash = password_hash($password, $algo = PASSWORD_DEFAULT);
    }
}
