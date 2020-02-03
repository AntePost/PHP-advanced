<?php
namespace App\tests;

use PHPUnit\Framework\TestCase;
use App\controllers\CartController;
use App\services\Request;
use App\models\repositories\ProductRepository;
use App\services\renders\TwigRenderServices;
use App\main\App;

class CartControllerTest extends TestCase
{
    public function setUp(): void
    {
        if (!headers_sent()) {
            session_start();
        }
    }
    
    public function testAddToCartActionWithAdd()
    {
        $_SERVER['HTTP_REFERER'] = '/';
        $_SERVER['REQUEST_URI'] = '/cart/addToCart?id=1';
        $config = include(__DIR__ . './../main/config.php');
        App::call()->run($config);
        $request = new Request();

        $product = [
            'id' => 1,
            'name' => 'Shirt 1',
            'price' => 10,
            'quantity' => 1,
        ];
        $products = $request->getSession('products');
        
        $this->assertContains($product, $products);
        unset($_SESSION['products']);
    }

    public function testAddToCartActionWithIncrease()
    {
        $request = new Request();
        $initialProduct = [
            'id' => 1,
            'name' => 'Shirt 1',
            'price' => 10,
            'quantity' => 1,
        ];
        $request->setSession('products', [$initialProduct]);
        
        $_SERVER['HTTP_REFERER'] = '/';
        $_SERVER['REQUEST_URI'] = '/cart/addToCart?id=1';
        $config = include(__DIR__ . './../main/config.php');
        App::call()->run($config);

        $increasedProduct = [
            'id' => 1,
            'name' => 'Shirt 1',
            'price' => 10,
            'quantity' => 2,
        ];
        $products = $request->getSession('products');
        
        $this->assertContains($increasedProduct, $products);
        unset($_SESSION['products']);
    }

    public function testRemoveFromCartActionWithRemove()
    {
        $request = new Request();
        $product = [
            'id' => 1,
            'name' => 'Shirt 1',
            'price' => 10,
            'quantity' => 1,
        ];
        $request->setSession('products', [$product]);

        $_SERVER['HTTP_REFERER'] = '/';
        $_SERVER['REQUEST_URI'] = '/cart/removeFromCart?id=1';
        $config = include(__DIR__ . './../main/config.php');
        App::call()->run($config);

        $products = $request->getSession('products');

        $this->assertEmpty($products);
        unset($_SESSION['products']);
    }

    public function testRemoveFromCartActionWithDecrease()
    {
        $request = new Request();
        $initialProduct = [
            'id' => 1,
            'name' => 'Shirt 1',
            'price' => 10,
            'quantity' => 2,
        ];
        $request->setSession('products', [$initialProduct]);

        $_SERVER['HTTP_REFERER'] = '/';
        $_SERVER['REQUEST_URI'] = '/cart/removeFromCart?id=1';
        $config = include(__DIR__ . './../main/config.php');
        App::call()->run($config);

        $decreasedProduct = [
            'id' => 1,
            'name' => 'Shirt 1',
            'price' => 10,
            'quantity' => 1,
        ];
        $products = $request->getSession('products');
        
        $this->assertContains($decreasedProduct, $products);
        unset($_SESSION['products']);
    }
}