<?php
namespace App\controllers;

use App\models\repositories\ProductRepository;
use App\main\App;

class ProductController extends Controller
{
    protected $defaultAction = 'products';

    public function productsAction()
    {
        $params = [
          'products' =>  App::call()->ProductRepository->getAll()
        ];

        echo $this->render('products', $params);
    }

}