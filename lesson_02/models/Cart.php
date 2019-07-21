<?php

namespace App\models;

/**
 * В БД используется составной первичный ключ, поэтому пришлось переопределить метод getOne.
 * getOne получает полную корзину пользователя, getAll - все элементы корзины всех пользователей.
 */
class Cart extends Model
{
    public $userId;
    public $productId;
    public $quantity;

    protected function getTableName()
    {
        return 'carts';
    }

    public function getOne(int $userId)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE userId = :id";
        return $this->db->findAll($sql, [':id' => $userId], get_class($this));
    }
}