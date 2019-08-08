<?php
namespace App\main;

use App\traits\TSingleton;
use App\services\renders\TwigRenderServices;
use App\services\Request;

class App
{
    use TSingleton;

    private $config;
    private $componentsData;
    private $components = [];

    static public function call()
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->config = $config;
        $this->componentsData = $config['components'];
        $this->runController();
    }

    public function runController()
    {
        $request = $this->Request;

        $defaultControllerName = $this->config['defaultControllerName'];
        $controllerName = $request->controllerName ?: $defaultControllerName;
        $actionName = $request->actionName;

        $controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRenderServices($this->config), $request);
            
            $componentName = ucfirst($controllerName) . 'Controller';
            
            if ($this->componentsData[$componentName]['allowed']) {
                $controller->run($actionName);
            } elseif ($request->getSession('user')->isAdmin === '1') {
                $controller->run($actionName);
            } else {
                $controller->redirect('/error');
            }
        }
    }

    public function __get(string $name)
    {

        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }
        
        if (array_key_exists($name, $this->componentsData)) {
            $class = $this->componentsData[$name]['class'];
            if (!class_exists($class)) {
                return null;
            }

            if (array_key_exists('config', $this->componentsData[$name])) {
                $config = $this->componentsData[$name]['config'];
                $component = new $class($config);
            } else {
                $component = new $class();
            }
            $this->components[$name] = $component;
            return $component;
        }

        echo '404: no such component';
        return null;
    }
}
