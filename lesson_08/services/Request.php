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
        if (!headers_sent()) {
            session_start();
        }
        
        if (array_key_exists('REQUEST_URI', $_SERVER)) {
            $this->requestString = $_SERVER['REQUEST_URI'];
        }
        
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

            if ($this->getParams('get', 'id')) {
                $this->id = (int)$this->getParams('get', 'id');
            }
        }
    }

    public function getParams($method, $key = null)
    {
        if (empty($key)) {
            return $this->params[$method];
        }
        return array_key_exists($key, $this->params[$method]) ? $this->params[$method][$key] : null;
    }

    public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }
        return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : [];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}