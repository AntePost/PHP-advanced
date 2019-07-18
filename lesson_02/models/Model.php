<?php

namespace App\models;

use App\services\DB as DB;

/**
 * Abstract class for fetching data from DB
 */
abstract class Model
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

    /**
     * Returns array with found element from DB
     * 
     * @param int $id ID of table row in DB
     * @return array
     */
    public function getOne(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->find($sql, [':id' => $id], get_class($this));
    }

    /**
     * Returns array of arrays with found elements from DB
     * 
     * @return array
     */
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->findAll($sql, [], get_class($this));
    }

    public function saveInDB(int $id = null)
    {
        // Приготавливаем параметры и переменные для интерполяции
        $params = [];
        if (!is_null($id)) {
            $params[':id'] = $id;
        }
        $keysWithoutColon = [];
        $keyValuePairs = [];
        foreach ($this as $key => $value) {
            if ($key !== 'db' AND $key !== 'id') {
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
        if (is_null($id)) {
            $sql = "INSERT INTO {$tableName} ({$keysWithoutColon}) VALUES ($keysWithColon)";
        } else {
            $sql = "UPDATE {$tableName} SET {$keyValuePairs} WHERE id = :id";
        }
        return $this->db->execute($sql, $params);
    }

    public function deleteFromDB(int $id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        $this->db->execute($sql, [':id' => $id]);
    }
}
