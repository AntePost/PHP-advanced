<?php

include $_SERVER['DOCUMENT_ROOT'] .
'/lesson_02/config/config.php';
include $PATH_TO_SERVICES . 'Autoload.php';

use App\services\Autoload as Autoload;
use App\services\DB as DB;
use App\models\Product as Product;
use App\models\User as User;
use App\models\Review as Review;
use App\models\Cart as Cart;

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
/* $user = new User();
$user->username = 'John';
$user->setPasswordHash('password');
$user->saveInDB();

$user->username = 'Jack';
$user->saveInDB(5);

$user->deleteFromDB(5); */