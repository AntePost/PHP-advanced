<?php
namespace App\models\repositories;

use App\models\entities\Product;

class ProductRepository extends Repository
{
    protected function getTableName()
    {
        return 'products';
    }

    protected function getEntityName()
    {
        return Product::class;
    }
}