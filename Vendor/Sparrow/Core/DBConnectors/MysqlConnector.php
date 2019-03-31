<?php

namespace Vendor\Sparrow\Core\DBConnectors;
use PDO;

class MysqlConnector extends BaseConnector
{
    protected $host;
    protected $base;
    protected $user;
    protected $pass;
    protected $charset;


    protected $parameters = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];


    public function __construct()
    {

        $this->host = env('host');
        $this->base = env('base');
        $this->user = env('user');
        $this->pass = env('password');
        $this->charset = env('charset');
        $this->createBaseConnector();

    }

    protected function prepareDSN(): string
    {
        return "mysql:host=$this->host;dbname=$this->base;charset=$this->charset";
    }

}
