<?php
namespace App\services;

class DB
{
    private $config;
    private $connect;

    public function __construct($config)
    {
        $this->config = $config;
    }

    protected function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getDSN(),
                $this->config['user'],
                $this->config['pass']
            );
            $this->connect->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }
        return $this->connect;
    }

    private function getDSN()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['db'],
            $this->config['charset']
        );
    }

    private function query(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function queryObject(string $sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(
            \PDO::FETCH_CLASS,
            $class
        );
        return $PDOStatement->fetch();
    }

    public function queryObjects(string $sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(
            \PDO::FETCH_CLASS,
            $class
        );
        return $PDOStatement->fetchAll();
    }

    public function execute(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }
}
