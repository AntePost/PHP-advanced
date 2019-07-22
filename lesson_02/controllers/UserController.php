<?php
namespace App\controllers;

use App\models\User as User;

class UserController
{
    protected $defaultAction = 'users';
    protected $action;
    protected $userInstance;

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        $this->userInstance = new User();
        
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404: no such method';
        }
    }

    public function userAction()
    {
        $userId = $_GET['id'];
        $params = [
            'user' => $this->userInstance->getOne($userId),
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
            'users' => $this->userInstance->getAll()
        ];

        echo $this->render('users', $params);
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);
        return $this->renderTemplate('layouts/main', [
            'content' => $content
        ]);
    }

    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include $_SERVER['DOCUMENT_ROOT'] . '/lesson_02/views/' . $template . '.php';
        return ob_get_clean();
    }
}
