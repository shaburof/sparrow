<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 07.04.19
 * Time: 8:55
 */

namespace Vendor\Sparrow\Console\ConsoleCommandsClass;


use Vendor\Sparrow\Core\Builder;
use Vendor\Sparrow\Core\DB\DB;

class Create
{
    protected $additionalParameters;
    protected $returnString;
    protected $className;
    protected $directoryPath = ROOT . 'App/';
    protected $namespace;

    public function __construct($additionalParameters)
    {
        $this->additionalParameters = $additionalParameters;
        if (count($this->additionalParameters) !== 0) $this->getControllerNameWithSplitByDots();
    }

    protected function checkTableAlreadyExist($table): bool
    {
        $db = Builder::sCreate(DB::class);
        return $db->tableIsExist($table);
    }

    protected function getControllerNameWithSplitByDots()
    {
        $tempControllerName = preg_replace('~\.~', '/', array_shift($this->additionalParameters));
        $explodePath = explode('/', $tempControllerName);
        if (count($explodePath) > 1) {
            $this->className = array_pop($explodePath);
            $this->directoryPath .= implode($explodePath, '/') . '/';
            $this->namespace .= "\\" . implode($explodePath, '\\');
        } else {
            $this->className = $tempControllerName;
        }
    }

    protected function fileExist(): bool //checkIsControllerExists
    {
        return file_exists("$this->directoryPath$this->className.php");
    }

    protected function createFolder(): void
    {
        @mkdir($this->directoryPath, 0777, true);
    }

    protected function searchAdditionalParameters(string $addParam): bool
    {
        return array_search($addParam, $this->additionalParameters, true) !== false;
    }

    protected function createFile(string $fileContent): bool
    {
        return (bool)file_put_contents("$this->directoryPath$this->className.php", $fileContent);
    }

}
