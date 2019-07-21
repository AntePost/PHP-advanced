<?php
namespace App\traits;

/**
 * Singleton realization
 */
trait TSingleton
{
    private static $instance;

    protected function __construct(){}
    protected function __clone(){}
    protected function __wakeup(){}
    
    /**
     * Creates a singular instance of a class
     * @return mixed
     */
    public function getInstance()
    {
        if (empty(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}
