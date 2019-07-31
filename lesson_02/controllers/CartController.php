<?php
namespace App\controllers;

use App\models\Cart as Cart;
use App\models\repositories\CartRepository;

class CartController extends BaseController
{
    protected $defaultAction = 'cart';

    public function cartAction()
    {
        $userId = $_GET['id'];
        $params = [
            'cart' => (new CartRepository())->getOne($userId),
            'id' => $userId
        ];

        if (is_null($params['id'])) {
            echo '404: no such cart';
            return;
        }

        echo $this->render('cart', $params);
    }
}
