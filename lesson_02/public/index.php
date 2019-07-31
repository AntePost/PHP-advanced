<?php

include $_SERVER['DOCUMENT_ROOT'] .
'./../config/config.php';
include $PATH_TO_SERVICES . 'Autoload.php';
include $PATH_TO_VENDOR . 'autoload.php';

use App\services\Autoload as Autoload;
//use App\vendor\Autoload as VAutoload;
use App\services\DB as DB;
use App\models\Product as Product;
use App\models\entities\User as User;
use App\models\repositories\UserRepository as UserRepository;
use App\models\Review as Review;
use App\models\Cart as Cart;

// spl_autoload_register([new Autoload(), 'loadClass']);
spl_autoload_register([new Autoload(), 'loadClass']);

// Выводит полученные объекты (cart через getOne выводит полную корзину пользователя)
/* $product = new Product();
var_dump($product->getOne(1));

echo '<br>';

$user = new User();
var_dump($user->getAll());

echo '<br>';

$review = new Review();
var_dump($review->getOne(1));

echo '<br>';

$cart = new Cart();
var_dump($cart->getOne(2));

echo '<br>';

var_dump($cart->getAll());*/

// Выполнение create, update и delete запросов к БД
// Create
/*$user = new User();
$userRepo = new UserRepository();
$user->username = 'Jimbo';
$user->setPasswordHash('password');
$userRepo->saveInDB($user);*/

// Update
/*$user = new User();;
$userRepo = new UserRepository();
$user->username = 'Jonah';
$user->id = '3';
$userRepo->saveInDB($user);*/

// Delete
/*$user = new User();
$userRepo = new UserRepository();
$user->id = '3';
$userRepo->deleteFromDB($user);*/

// Проверка метода getKey()
$request = new \App\services\Request();
var_dump($request->getKey('get', 'id'));

// Вызов контроллера

$controllerName = $request->controllerName ?: 'user';
$actionName = $request->actionName;

$controllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new \App\services\renders\TwigTemplateRenderer(), $request);
    $controller->run($actionName);
}