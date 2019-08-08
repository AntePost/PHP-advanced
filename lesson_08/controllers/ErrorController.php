<?php
namespace App\controllers;

class ErrorController extends Controller
{
    protected $defaultAction = 'accessDenied';

    public function accessDeniedAction()
    {
        echo $this->render('accessDenied');
    }
}