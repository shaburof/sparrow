<?php

namespace Vendor\Sparrow\Core\DB;

use Vendor\Sparrow\Core\DBConnectors\BaseConnector;
use Vendor\Sparrow\Core\DBConnectors\MysqlConnector;
use PDO;
use Vendor\Sparrow\Core\Errors\Errors;

class DBMain
{
    protected $conn;
    protected $stmt;
    protected $fetchDataFromDatabase;
    protected $className;
    protected $lastInsertId = null;
    protected $statusOfExecutionOperation=null;


    public function __construct($className = null)
    {
        $baseDriver = $this->getBaseConfiguration();

        $this->conn = getClass('connector')->conn();
//        $this->conn = (new $baseDriver)->conn();
//        $this->conn = getClass(MysqlConnector::class)->conn();
//        $this->conn = BaseConnector::getDBConnentor()->conn();

        $this->className = $className;

    }

    // close database connection
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
        return $this->fetchDataFromDatabase;
    }

    public function first()
    {
        $this->fetchDataFromDatabase = $this->fetch();
        return !empty($this->fetchDataFromDatabase[0]) ? $this->fetchDataFromDatabase[0] : [];
    }

    public function last()
    {
        $this->fetchDataFromDatabase = $this->fetch();
        return !empty($this->fetchDataFromDatabase[count($this->fetchDataFromDatabase) - 1]) ? $this->fetchDataFromDatabase[count($this->fetchDataFromDatabase) - 1] : [];
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
        $this->statusOfExecutionOperation = $this->stmt->execute($parameters); // $this->statusOfExecutionOperation - store status of operation

        $lastInsertId = $this->conn->lastInsertId();    // get last insert autoincrement id for insert operation
        $this->lastInsertId = !empty($lastInsertId) ? $lastInsertId : null;
    }

    protected function fetch()
    {
        $tempFetchAll = null;
        if ($this->className) $tempFetchAll = $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
        else $tempFetchAll = $this->stmt->fetchAll(PDO::FETCH_CLASS);

        return $tempFetchAll;
    }

    public function getLastInsertId()
    {
        return !empty($this->lastInsertId) ? $this->lastInsertId : null;
    }

    /**
     * @param $query array
     * @return mixed
     */
    public function raw(array $query): object
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

    public static function sraw(array $query): object
    {
        $db = new self();
        return $db->raw($query);
    }

    public function __destruct()
    {
        unset($this->conn);
    }

}
