<?php
namespace App\services;

class Request
{
    public $requestString;
    public $controllerName;
    public $actionName;
    public $id;
    public $params;

    public function __construct()
    {
        session_start();
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];

            $this->params = [
              'get' => $_GET,
              'post' => $_POST,
            ];

            $this->id = (int)$_GET['id'];
        }
    }
    
    public function getKey($method, $key = null)
    {
        if (is_null($key)) {
            return $this->params[$method];
        } else {
            return $this->params[$method][$key];
        }
    }

    public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }
        return array_key_exists($key, $_SESSION)
            ? $_SESSION[$key]
            : [];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}