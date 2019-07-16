<?php

namespace App\models;

class Review extends Model
{
    protected $id;
    protected $productId;
    protected $authorName;
    protected $text;

    protected function getTableName()
    {
        return 'reviews';
    }
}