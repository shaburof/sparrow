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

    protected function createBaseConnector():void
    {
        $this->conn = new PDO($this->prepareDSN(), $this->user, $this->pass, $this->parameters);
    }
}
