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

$product = new Product(new DB());
echo $product->getOne(12);

echo '<br>';

$user = new User(new DB());
echo $user->getAll();

echo '<br>';

$review = new Review(new DB());
echo $review->getOne(4);

echo '<br>';

$cart = new Cart(new DB());
echo $cart->getOne(4);

echo '<br>';

echo $cart->getAll();