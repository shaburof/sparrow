<?php

namespace Vendor\Sparrow\Core\DB;

use Vendor\Sparrow\Core\DBConnectors\MysqlConnector;
use PDO;
use Vendor\Sparrow\Core\Errors\Errors;

class DBMain
{
    protected $conn;
    protected $stmt;
    protected $fetchDataFromDatabase;
    protected $className;


    public function __construct($className = null)
    {
        $baseDriver = $this->getBaseConfiguration();
        $this->conn = (new $baseDriver)->conn();
        $this->className = $className;

    }

    protected function close(): void
    {
        unset($this->conn);
    }

    protected function getBaseConfiguration(): string
    {
        return '\Vendor\Sparrow\Core\DBConnectors\\' . ucfirst(strtolower(env('DBDRIVER'))) . 'Connector';
    }

    public function all()
    {
        $this->fetchDataFromDatabase = $this->fetch();
        $this->close();
        return $this->fetchDataFromDatabase;
    }

    public function first()
    {
        $this->fetchDataFromDatabase = $this->fetch();
        $this->close();
        return $this->fetchDataFromDatabase[0];
    }

    public function last()
    {
        $this->fetchDataFromDatabase = $this->fetch();
        $this->close();
        return $this->fetchDataFromDatabase[count($this->fetchDataFromDatabase) - 1];
    }

    protected function prepareQuery(string $query)
    {
        $this->stmt = $this->conn->query($query);
    }

    protected function prepareQueryWithParameters(string $query)
    {
        try {
            $this->stmt = $this->conn->prepare($query);
        } catch (\PDOException $e) {
            throw new Errors($e);
        }
    }

    protected function bindParameters(array $parameters): void
    {
        $this->stmt->execute($parameters);
    }

    protected function fetch()
    {
        $tempFetchAll = null;
        if ($this->className) $tempFetchAll = $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
        else $tempFetchAll = $this->stmt->fetchAll(PDO::FETCH_CLASS);

        return $tempFetchAll;
    }

    /**
     * @param $query string
     * @param $parameters array, default null
     * @param $class string, default null
     * @return mixed
     */
//    public function raw(string $query, array $parameters = null, string $class = null): object
    public function raw(array $query, string $class = null): object
    {
        $parameters = $query[1] ?? null;
        $query = $query[0];
        if ($parameters) {
            $this->prepareQueryWithParameters($query);
            $this->bindParameters($parameters);
        } else {
            $this->prepareQuery($query);
        }
        return $this;
    }

    public static function sraw(array $query, string $class = null): object
//    public static function sraw(string $query, array $parameters = null, string $class = null): object
    {
        $db = new self();
        return $db->raw($query, $class);
    }


}
