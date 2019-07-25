<?php
namespace App\controllers;

abstract class BaseController
{
    protected $defaultAction = 'index';
    protected $action;
    protected $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404: no such method';
        }
    }

    public function render($template, $params = [])
    {
        //$content = $this->renderTemplate($template, $params);
        $content = $template . '.html';
        return $this->renderTemplate('layouts/main', [
            'content' => $content,
            'params' => $params
        ]);
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }
}