<?php
/**
 * Created by PhpStorm.
 * User: lastochka
 * Date: 07.04.19
 * Time: 8:55
 */

namespace Vendor\Sparrow\Console\ConsoleCommandsClass;


class Create
{
    protected $additionalParameters;
    protected $returnString;

    protected function searchAdditionalParameters(string $addParam): bool
    {
        return array_search($addParam, $this->additionalParameters, true) !== false;
    }

    protected function createFile(string $fullPathToFile, string $fileContent): bool
    {
        return (bool)file_put_contents($fullPathToFile, $fileContent);
    }

}
