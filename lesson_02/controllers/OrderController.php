<?php
namespace App\controllers;

use App\models\entities\Order;
use App\models\repositories\OrderRepository;

class OrderController extends BaseController
{
    const PRODUCTS = 'products';

    protected $defaultAction = 'makeOrder';

    public function makeOrderAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $order = new Order();
            $order->username = $_POST['username'];
            $order->contact = $_POST['contact'];
            $order->address = $_POST['address'];
            $order->cart = json_encode($this->request->getSession(self::PRODUCTS));
            (new OrderRepository)->saveInDB($order);
            return $this->redirect();
        } else {
            return $this->redirect();
        }
    }
}