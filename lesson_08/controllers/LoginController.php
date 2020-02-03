<?php
namespace App\controllers;

use App\models\entities\User;
use App\main\App;

class LoginController extends Controller
{
    protected $defaultAction = 'login';

    public function loginAction()
    {
        $loginMessage = $this->request->getSession('loginMessage') ?: 'Enter your username and password';
        $user = $this->request->getSession('user');
        echo $this->render('login', ['loginMessage' => $loginMessage, 'user' => $user]);
    }

    public function authAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = App::call()->UserRepository->getOne($_POST['username'], 'username');
            var_dump($user);

            if (empty($user)) {
                $this->request->setSession('loginMessage', "Wrong login");
                $this->redirect();
            }

            if (password_verify($_POST['password'], $user->passwordHash)) {
                unset($user->passwordHash);
                $this->request->setSession('user', $user);
                $this->request->setSession('loginMessage', "You're logged in as {$user->username}");
                $this->redirect();
            } else {
                $this->request->setSession('loginMessage', "Wrong password");
                $this->redirect();
            }
        }
    }

    public function logoutAction()
    {
        session_destroy();
        $this->redirect();
    }
}