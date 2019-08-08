<?php
namespace App\models\repositories;

use App\main\App;

abstract class Repository
{
    protected $db;

    public function __construct()
    {
        $this->db = App::call()->db;
    }

    abstract protected function getTableName();

    abstract protected function getEntityName();

    public function getOne($param, $paramName = 'id')
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE $paramName = :$paramName";
        return $this->db->queryObject(
            $sql,
            $this->getEntityName(),
            [":$paramName" => $param]
        );
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryObjects($sql, $this->getEntityName());
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
