<?php
namespace App\models\repositories;

use App\models\entities\User;

class UserRepository extends Repository
{

    protected function getTableName()
    {
        return 'users';
    }

    protected function getEntityName()
    {
        return User::class;
    }
}