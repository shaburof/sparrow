<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 08.04.2019
 * Time: 13:52
 */

namespace Vendor\Sparrow\Console\ConsoleCommandsClass;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\DB\DB;
use Vendor\Sparrow\Core\DB\DBMain;

class CreateAuth extends Create
{
    // :TODO change 'created_at' and 'updated_at' fields to dateTime format. Check how there work if set timestamp format.
    private $createTableQuery = "CREATE TABLE `User` (
                                      `Id` int(11) NOT NULL AUTO_INCREMENT,
                                      `name` varchar(100) NOT NULL DEFAULT '',
                                      `email` varchar(100) NOT NULL DEFAULT '',
                                      `password` varchar(255) NOT NULL DEFAULT '',
                                      `created_at` DATETIME DEFAULT NULL,   
                                      `updated_at` DATETIME DEFAULT NULL,
                                      PRIMARY KEY (`Id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    protected $authModelDirectoryPath = ROOT . 'App/Model/User.php';
    protected $modelNamespace = 'App\Model';
    protected $modelString;


    public function __construct()
    {
        $this->modelString = <<<HTML
<?php

namespace $this->modelNamespace;


use Vendor\Sparrow\Core\Model\Model;

class User extends Model
{

}
HTML;
    }


    public function create(): string
    {
        if ($this->checkAuthTableAlreadyExist()) return "Table \"user\" already exists" . PHP_EOL;

        $this->createAuthTable();
        $this->createFile($this->authModelDirectoryPath,$this->modelString);

        return 'Auth table successfully created' . PHP_EOL;
    }

    protected function checkAuthTableAlreadyExist(): bool
    {
        $db = Builder::sCreate(DB::class);
        return $db->tableIsExist('user');
    }

    protected function createAuthTable(): void
    {
        DB::sraw([$this->createTableQuery]);
    }
}
