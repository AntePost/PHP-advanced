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
    public function __construct(DB $db)
    {
        $this->db = $db;
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
        $sql = "SELECT * FROM {$tableName} WHERE id = {$id}";
        return $this->db->find($sql);
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
        return $this->db->findAll($sql);
    }
}
