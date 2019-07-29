<?php
namespace App\controllers;

use App\models\User as User;
use App\models\repositories\UserRepository;

class UserController extends BaseController
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        $userId = $this->getId();
        $params = [
            'user' => (new UserRepository())->getOne($userId),
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
            'users' => (new UserRepository())->getAll()
        ];

        echo $this->render('users', $params);
    }
}
