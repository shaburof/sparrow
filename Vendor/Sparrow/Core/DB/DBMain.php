<?php

namespace Vendor\Sparrow\Core\DB;

use Vendor\Sparrow\Core\DBConnectors\MysqlConnector;
use PDO;
class DBMain
{
    protected $conn;
    protected $stmt;
    protected $fetchDataFromDatabase;

    public function __construct()
    {
        $baseDriver = $this->getBaseConfiguration();
        $this->conn = (new $baseDriver)->conn();
    }

    protected function close(): void
    {
        unset($this->conn);
    }

    protected function getBaseConfiguration(): string
    {
        return '\Vendor\Sparrow\Core\DBConnectors\\'.ucfirst(strtolower(env('DBDRIVER'))) . 'Connector';
    }

    public function all()
    {
        return $this->fetchDataFromDatabase;
    }

    public function first()
    {
        return $this->fetchDataFromDatabase[0];
    }

    public function last()
    {
        return $this->fetchDataFromDatabase[count($this->fetchDataFromDatabase) - 1];
    }
    protected function prepareQuery(string $query)
    {
        $this->stmt = $this->conn->query($query);
    }

    protected function prepareQueryWithParameters(string $query)
    {
        $this->stmt = $this->conn->prepare($query);
    }

    protected function bindParameters(array $parameters): void
    {
        $this->stmt->execute($parameters);
    }

    protected function fetch()
    {
        return $this->stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * @param $query string
     * @param null $parameters array
     * @return mixed
     */
    public function raw(string $query, array $parameters = null) :DB
    {
        if ($parameters) {
            $this->prepareQueryWithParameters($query);
            $this->bindParameters($parameters);
        } else {
            $this->prepareQuery($query);
        }
        $this->fetchDataFromDatabase = $this->fetch();

        return $this;
    }
}
