<?php
namespace App\controllers;

use App\main\App;
use App\models\entities\User;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function usersAction()
    {
        $params = [
          'users' =>  App::call()->UserRepository->getAll()
        ];

        echo $this->render('users', $params);
    }

    public function addUserAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->username = $_POST['username'];
            $user->setPasswordHash($_POST['password']);
            if ($_POST['admin']) {
                $user->isAdmin = 1;
            } else {
                $user->isAdmin = 0;
            }
            App::call()->UserRepository->saveInDB($user);
            return $this->redirect();
        }
    }

    public function deleteUserAction()
    {
        $id = $this->getId();
        $user = App::call()->UserRepository->getOne($id);
        App::call()->UserRepository->deleteFromDB($user);
        return $this->redirect();
    }
}