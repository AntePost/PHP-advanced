<?php
namespace App\controllers;

class IndexController extends Controller
{
    protected $defaultAction = 'index';

    public function indexAction()
    {
        echo $this->render('index');
    }
}
