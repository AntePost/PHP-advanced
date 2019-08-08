<?php
namespace App\models\entities;

class Product extends Entity
{
    public $id;
    public $name;
    public $price;
    public $pathToImage;
    public $description;
    public $category;
}