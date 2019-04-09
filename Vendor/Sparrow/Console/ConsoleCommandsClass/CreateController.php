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
    protected $directoryPath = ROOT . 'App/Controllers/';
    protected $namespace = 'App\Controllers';
    private $controllerString;
    protected $controllerStringWithResourceMethods;

    public function __construct($additionalParameters)
    {

        parent::__construct($additionalParameters);
        $this->controllerString = <<<HTML
<?php

namespace $this->namespace;

class $this->className
{

HTML;
        $this->controllerStringWithResourceMethods = <<<HTML
    public function index(){

    }
    public function show(\$id){

    }
    public function create(){

    }
    public function store(){

    }
    public function edit(){

    }
    public function update(\$id){

    }
    public function destroy(\$id){

    }
HTML;
        $this->addExtraParameters();
    }

    protected function addExtraParameters(): void
    {
        if ($this->searchAdditionalParameters('-r')) {
            $this->controllerString .= $this->controllerStringWithResourceMethods;
        }
    }


    public function create(): string
    {
        if ($this->fileExist()) {
            $this->returnString = "controller \"$this->className\" already exist";
        } else {
            $this->createFolder();
            $this->createControllerFile()
                ? $this->returnString = 'controller successfully created' . PHP_EOL
                : $this->returnString = 'Error creating controller' . PHP_EOL;
        }

        return $this->returnString . PHP_EOL;
    }


    protected function createControllerFile(): bool
    {
        $this->controllerString .= '}'; // add the closing curly brace
        return $this->createFile($this->controllerString);
    }

}
