<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 07.04.19
 * Time: 8:55
 */

namespace Vendor\Sparrow\Console\ConsoleCommandsClass;


class CreateController extends Create
{
    protected $controllerDirectoryPath = ROOT . 'App/Controllers/';
    protected $controllerName;
    protected $controllerNamespace = 'App\Controllers';
    private $controllerString;

    public function __construct($additionalParameters)
    {
        $this->additionalParameters = $additionalParameters;
        $this->getControllerNameWithSplitByDots();
        $this->controllerString = <<<HTML
<?php

namespace $this->controllerNamespace;

class $this->controllerName
{
}
HTML;


    }

    protected function getControllerNameWithSplitByDots()
    {
        $tempControllerName = preg_replace('~\.~', '/', array_shift($this->additionalParameters));

        $explodePath = explode('/', $tempControllerName);
        if (count($explodePath) > 1) {
            $this->controllerName = array_pop($explodePath) ;
            $this->controllerDirectoryPath .= implode($explodePath, '/') . '/';
            $this->controllerNamespace .= "\\".implode($explodePath, '\\');
        } else {
            $this->controllerName = $tempControllerName;
        }
    }

    public function create(): string
    {
        if($this->checkIsControllerExists()){
            $this->returnString="controller \"$this->controllerName\" already exist";
        } else {
            $this->createFolder();
            $this->createControllerFile($this->controllerString)
                ?$this->returnString = 'controller successfully created' . PHP_EOL
                :$this->returnString = 'Error creating controller' . PHP_EOL;
        }

        return $this->returnString . PHP_EOL;
    }

    protected function createFolder(): void
    {
        @mkdir($this->controllerDirectoryPath, 0777, true);
    }

    protected function createControllerFile($controllerString): bool
    {
        return (bool)file_put_contents("$this->controllerDirectoryPath$this->controllerName.php", $controllerString);
    }


    protected function checkIsControllerExists(): bool
    {
        return file_exists("$this->controllerDirectoryPath$this->controllerName.php");
    }

}
