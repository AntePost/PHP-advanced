<?php
namespace App\controllers;

use App\models\Product as Product;

class productController
{
    protected $defaultAction = 'products';
    protected $action;
    protected $productInstance;

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        $this->productInstance = new Product();

        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404: no such method';
        }
    }

    public function productAction()
    {
        $productId = $_GET['id'];
        $params = [
            'product' => $this->productInstance->getOne($productId),
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
            'products' => $this->productInstance->getAll()
        ];

        echo $this->render('products', $params);
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);
        return $this->renderTemplate('layouts/main', [
            'content' => $content
        ]);
    }

    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include $_SERVER['DOCUMENT_ROOT'] . '/lesson_02/views/' . $template . '.php';
        return ob_get_clean();
    }
}
