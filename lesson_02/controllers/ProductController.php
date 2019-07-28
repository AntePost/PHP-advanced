<?php
namespace App\controllers;

use App\models\Product as Product;

class productController extends BaseController
{
    protected $defaultAction = 'products';

    public function productAction()
    {
        $productId = $_GET['id'];
        $params = [
            'product' => Product::getOne($productId),
            'id' => $productId
        ];

        if (is_null($params['id'])) {
            echo '404: no such product';
            return;
        }

        echo $this->render('product', $params);
    }

    public function productsAction()
    {
        $params = [
            'products' => Product::getAll()
        ];

        echo $this->render('products', $params);
    }
}
