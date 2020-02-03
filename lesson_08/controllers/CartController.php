<?php
namespace App\controllers;

use App\models\repositories\ProductRepository;
use App\main\App;

class CartController extends Controller
{
    const PRODUCTS = 'products';

    protected $defaultAction = 'cart';

    public function cartAction()
    {
        $params = [
            'cart' => $this->request->getSession(self::PRODUCTS)
        ];

        echo $this->render('cart', $params);
    }
    
    public function addToCartAction()
    {
        $id = $this->getId();
        if (empty($id)) {
            return $this->redirect();
        }
        $product = App::call()->ProductRepository->getOne($id);
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

    public function removeFromCartAction()
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
        $this->request->setSession(self::PRODUCTS, []);
        return $this->redirect();
    }
}