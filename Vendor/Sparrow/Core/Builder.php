<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 8:27
 */

namespace Vendor\Sparrow\Core;


use Vendor\Sparrow\Core\Errors\Errors;
use Vendor\Sparrow\Core\Objects\NullObject;

class Builder
{
    // :TODO добавил тип принимаемой переменной и тип для return
    protected function checkExistingClass(string $class): bool
    {
        return class_exists($class);
    }

    public function create(string $class, bool $store = false, $parameters = null): object
    {
        if ($this->checkExistingClass($class)) {
            $newClass = new $class($parameters);
            if ($store) setClass($newClass);
            return $newClass;
        }
        throw new Errors("не могу создат класс $class, класс отсутствует");
    }


}
