<?php
namespace App\models\entities;

/**
 * Class Cart
 * @package App\models\entities
 */
class Cart extends Entity
{
    public $userId;
    public $productId;
    public $quantity;
}
