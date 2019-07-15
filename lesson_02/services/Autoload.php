<?php

namespace App\services;

class Autoload
{
    public function loadClass($className)
    {
        global $PATH_TO_LESSON;
        $pathToFile = preg_replace('/App/', $PATH_TO_LESSON, $className) . '.php';
        include $pathToFile;
    }
}
