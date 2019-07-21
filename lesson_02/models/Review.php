<?php

namespace App\models;

class Review extends Model
{
    public $id;
    public $productId;
    public $authorName;
    public $text;

    protected function getTableName()
    {
        return 'reviews';
    }
}