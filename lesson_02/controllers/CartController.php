<?php
namespace App\controllers;

use App\models\Cart as Cart;
use App\models\repositories\CartRepository;
use App\models\repositories\ProductRepository;

class CartController extends BaseController
{
    const PRODUCTS = 'products';
    
    protected $defaultAction = 'cart';

    public function cartAction()
    {
        /*$userId = $_GET['id'];
        $params = [
            'cart' => (new CartRepository())->getOne($userId),
            'id' => $userId
        ];

        if (is_null($params['id'])) {
            echo '404: no such cart';
            return;
        }

        echo $this->render('cart', $params);*/

        // print_r($_SESSION);

        $params = [
            'cart' => $this->request->getSession(self::PRODUCTS)
        ];

        echo $this->render('cart', $params);
    }

    public function addCartAction()
    {
        $id = $this->getId();
        if (empty($id)) {
            return $this->redirect();
        }
        $product = (new ProductRepository())->getOne($id);
        if (empty($product)) {
            return $this->redirect();
        }

        $products = $this->request->getSession(self::PRODUCTS);
        if (array_key_exists($id, $products)) {
            $products[$id]['quantity']++;
        } else {
            $products[$id] = [
                'id' => $id,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
            ];
        }

        $this->request->setSession(self::PRODUCTS, $products);
        return $this->redirect();
    }

    public function removeCartAction()
    {
        $id = $this->getId();
        if (empty($id)) {
            return $this->redirect();
        }

        $products = $this->request->getSession(self::PRODUCTS);
        if ($products[$id]['quantity'] > 1) {
            $products[$id]['quantity']--;
        } else {
            unset($products[$id]);
        }

        $this->request->setSession(self::PRODUCTS, $products);
        return $this->redirect();
    }

    public function clearCartAction()
    {
        session_destroy();
        return $this->redirect();
    }
}
