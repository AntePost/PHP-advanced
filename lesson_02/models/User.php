<?php

namespace App\models;

class User extends Model
{
    protected $id;
    protected $username;
    protected $passwordHash;

    protected function getTableName()
    {
        return 'users';
    }
}