<?php

namespace Vendor\Sparrow\Core\DBConnectors;

use PDO;

abstract class BaseConnector
{


    protected $conn;

    public function conn(): PDO
    {
        return $this->conn;
    }

    protected function createBaseConnector(): void
    {
        $this->conn = new PDO($this->prepareDSN(), $this->user, $this->pass, $this->parameters);
    }

    // return base connector with env('DBDRIVER') type
    public static function getDBConnentor(): BaseConnector
    {
        $dbClass = '\Vendor\Sparrow\Core\DBConnectors\\' . ucfirst(strtolower(env('DBDRIVER'))) . 'Connector';

        return new $dbClass();
    }
}
