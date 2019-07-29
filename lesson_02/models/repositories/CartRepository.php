<?php

namespace App\models\repositories;

use App\models\entities\Cart;

class CartRepository extends Repository
{

    protected function getTableName()
    {
        return 'carts';
    }

    protected function getEntityName()
    {
        return Cart::class;
    }

    public function getOne(int $userId)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE userId = :id";
        return $this->db->findAll($sql, [':id' => $userId], $this->getEntityName());
    }
}