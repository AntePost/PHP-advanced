<?php
namespace App\traits;

trait TSingleton
{
    private static $instance;

    protected function __construct(){}
    protected function __clone(){}
    protected function __wakeup(){}
    
    public static function getInstance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
