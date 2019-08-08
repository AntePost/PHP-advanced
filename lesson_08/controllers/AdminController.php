<?php
namespace App\controllers;

class AdminController extends Controller
{
    protected $defaultAction = 'admin';

    public function adminAction()
    {
        echo $this->render('admin');
    }
}