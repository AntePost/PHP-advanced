<?php

namespace App\models\repositories;

use App\services\DB as DB;
// use App\models\entities\Entity;

/**
 * Abstract class for fetching data from DB
 */
abstract class Repository
{   
    /**
     * @var DB Class for working with DB
     */
    protected $db;

    /**
     * @param DB $db Class for working with DB
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * Returns table name
     * 
     * @return string
     */
    abstract protected function getTableName();

    abstract protected function getEntityName();

    /**
     * Returns array with found element from DB
     * 
     * @param int $id ID of table row in DB
     * @return array
     */
    public function getOne(int $id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return DB::getInstance()->find($sql, [':id' => $id], $this->getEntityName());
    }

    /**
     * Returns array of arrays with found elements from DB
     * 
     * @return array
     */
    public function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return DB::getInstance()->findAll($sql, [], $this->getEntityName());
    }

    public function saveInDB($entity)
    {
        // Приготавливаем параметры и переменные для интерполяции
        $params = [];
        if (!is_null($entity->id)) {
            $params[':id'] = $entity->id;
        }
        $keysWithoutColon = [];
        $keyValuePairs = [];
        foreach ($entity as $key => $value) {
            if ($key !== 'id') {
                $params[":{$key}"] = $value;
                $keysWithoutColon[] = $key;
                $keyValuePairs[] = "{$key} = :{$key}";
            }
        }
        $keysWithoutColon = implode(', ', $keysWithoutColon);
        $keysWithColon = implode(', ', array_keys($params));
        $keyValuePairs = implode(', ', $keyValuePairs);
        $tableName = $this->getTableName();

        // Подготавливаем и выполняем запрос
        if (is_null($entity->id)) {
            $sql = "INSERT INTO {$tableName} ({$keysWithoutColon}) VALUES ($keysWithColon)";
        } else {
            $sql = "UPDATE {$tableName} SET {$keyValuePairs} WHERE id = :id";
        }
        return $this->db->execute($sql, $params);
    }

    public function deleteFromDB($entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->db->execute($sql, [':id' => $entity->id]);
    }
}
