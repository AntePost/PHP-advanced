<?php
namespace App\controllers;

abstract class Controller
{
    protected $defaultAction;
    protected $action;
    protected $renderer;
    protected $request;

    public function __construct($renderer, $request)
    {
        $this->renderer = $renderer;
        $this->request = $request;
    }

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404: no such action';
        }
    }

    public function render($template, $params = [])
    {
        return $this->renderer->renderTmpl($template, $params);
    }

    protected function getId()
    {
        return $this->request->id;
    }

    public function redirect($path = '')
    {
        if (empty($path)) {
            $path = $_SERVER['HTTP_REFERER'];
        }
        if (!headers_sent()) {
            return header('Location:' . $path);
        }
    }
}
