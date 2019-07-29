<?php
namespace App\controllers;

use App\models\Product as Product;
use App\models\repositories\ProductRepository;

class ProductController extends BaseController
{
    protected $defaultAction = 'products';

    public function productAction()
    {
        $productId = $_GET['id'];
        $params = [
            'product' => (new ProductRepository())->getOne($productId),
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
            'products' => (new ProductRepository())->getAll()
        ];

        echo $this->render('products', $params);
    }
}
