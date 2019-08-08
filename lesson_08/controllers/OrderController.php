<?php
namespace App\controllers;

use App\models\entities\Order;
use App\models\repositories\OrderRepository;
use App\main\App;

class OrderController extends Controller
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

            App::call()->OrderRepository->saveInDB($order);
            $this->request->setSession(self::PRODUCTS, []);

            return $this->redirect();
        } else {
            return $this->redirect();
        }
    }
}