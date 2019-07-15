<?php

namespace App\models;

class Product extends Model
{
    protected $id;
    protected $name;
    protected $price;
    protected $pathToImage;
    protected $description;
    protected $category;

    protected function getTableName()
    {
        return 'products';
    }
}
