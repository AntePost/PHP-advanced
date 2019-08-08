<?php
return [
    'rootPath' => $_SERVER['DOCUMENT_ROOT'] .'/../',
    'vendorPath' => $_SERVER['DOCUMENT_ROOT'] .'/../vendor/',
    'viewsPath' => $_SERVER['DOCUMENT_ROOT'] .'/../views/',
    'name' => 'My shop',
    'defaultControllerName' => 'index',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'user' => 'root',
                'pass' => 'mysql',
                'driver' => 'mysql',
                'db' => 'php_basic',
                'host' => 'localhost',
                'charset' => 'UTF8',
            ]
        ],
        'Request' => [
            'class' => \App\services\Request::class,
        ],
        'ProductRepository' => [
            'class' => \App\models\repositories\ProductRepository::class
        ],
        'OrderRepository' => [
            'class' => \App\models\repositories\OrderRepository::class
        ],
        'UserRepository' => [
            'class' => \App\models\repositories\UserRepository::class
        ],
        'AdminController' => [
            'class' => \App\controllers\AdminController::class,
            'allowed' => false,
        ],
        'CartController' => [
            'class' => \App\controllers\CartController::class,
            'allowed' => true,
        ],
        'IndexController' => [
            'class' => \App\controllers\IndexController::class,
            'allowed' => true,
        ],
        'LoginController' => [
            'class' => \App\controllers\LoginController::class,
            'allowed' => true,
        ],
        'OrderController' => [
            'class' => \App\controllers\OrderController::class,
            'allowed' => true,
        ],
        'ProductController' => [
            'class' => \App\controllers\ProductController::class,
            'allowed' => true,
        ],
        'UserController' => [
            'class' => \App\controllers\UserController::class,
            'allowed' => false,
        ],
        'ErrorController' => [
            'class' => \App\controllers\ErrorController::class,
            'allowed' => true,
        ],

    ],
];
