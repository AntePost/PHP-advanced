<?php

namespace App\services;

class DB
{
    use \App\traits\TSingleton;

    private $config = [
        'user' => 'root',
        'pass' => 'mysql',
        'driver' => 'mysql',
        'bd' => 'php_basic',
        'host' => 'localhost',
        'charset' => 'UTF8',
    ];

    /**
     * @var \PDO|null
     */
    protected $connect = null;

    protected function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getDSN(),
                $this->config['user'],
                $this->config['pass']
            );
            // Задал fetch mode ниже в функции query
            /* $this->connect->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_CLASS
            ); */
        }
        return $this->connect;
    }

    /**
     * Creating a string for settings
     * @return string
     */
    private function getDSN()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['bd'],
            $this->config['charset']
        );
    }

    /**
     * Performs a query
     *
     * @param string $sql 'SELECT * FROM users WHERE id = :id'
     * @param array $params [':id' => 123]
     * @return \PDOStatement
     */
    private function query(string $sql, array $params = [], string $className = '')
    {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement;
    }

    /**
     * Fetches one row
     *
     * @param string $sql
     * @param array $params
     * @return array|mixed
     */
    public function find(string $sql, array $params = [], string $className)
    {
        return $this->query($sql, $params, $className)->fetch();
    }

    /**
     * Fetches all rows (except for Cart object where it fetches a single cart)
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function findAll(string $sql, array $params = [], string $className)
    {
        return $this->query($sql, $params, $className)->fetchAll();
    }

    /**
     * Performs a query with no response
     *
     * @param string $sql
     * @param array $params
     */
    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }
}
