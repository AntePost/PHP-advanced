<?php
namespace App\controllers;

use App\models\User as User;

class UserController extends BaseController
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        $userId = $_GET['id'];
        $params = [
            'user' => User::getOne($userId),
            'id' => $userId
        ];

        if (is_null($params['id'])) {
            echo '404: no such user';
            return;
        }

        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' => User::getAll()
        ];

        echo $this->render('users', $params);
    }
}
