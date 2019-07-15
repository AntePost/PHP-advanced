<?php

namespace App\models;

/**
 * В БД используется составной первичный ключ, поэтому пришлось переопределить метод getOne.
 * getOne получает полную корзину пользователя, getAll - все элементы корзины всех пользователей.
 */
class Cart extends Model
{
    protected $userId;
    protected $productId;
    protected $quantity;

    protected function getTableName()
    {
        return 'cart';
    }

    public function getOne(int $userId)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE user_id = {$userId}";
        return $this->db->find($sql);
    }
}