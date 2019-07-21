<?php

namespace App\models;

class Product extends Model
{
    public $id;
    public $name;
    public $price;
    public $pathToImage;
    public $description;
    public $category;

    protected function getTableName()
    {
        return 'products';
    }
}
