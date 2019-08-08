<?php
namespace App\models\repositories;

use App\models\entities\Order;

class OrderRepository extends Repository
{
    protected function getTableName()
    {
        return 'orders';
    }

    protected function getEntityName()
    {
        return Order::class;
    }
}