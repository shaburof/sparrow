<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 8:48
 */

namespace Vendor\Sparrow\Core;

use Vendor\Sparrow\Core\Errors\Errors;
use Vendor\Sparrow\Core\Objects\NullObject;

class ClassStore
{
    protected static $self;
    protected $class = [];


    public function get(string $class): object
    {
        $class = $this->extractClassNameFromString($class);

        if ($this->checkClassKeyExists($class)) {
            return $this->class[$class];
        }
        throw new Errors("класс $class отсутствует в хранилище ClassStore");
    }

    public function set(object $class): void
    {
        if ($this->checkClassExists($class)) {
            throw new Errors("класс '$class' уже есть в хранилище");

        }
        $this->class += [$this->extractClassNameFromObject($class) => $class];
    }

    protected function extractClassNameFromObject(object $class): string
    {
        $tempArray = explode('\\', get_class($class));
        return array_pop($tempArray);
    }

    protected function extractClassNameFromString(string $class): string
    {
        $tempArray = explode('\\', $class);
        return count($tempArray) > 0 ? array_pop($tempArray) : $class;
    }

    protected function checkClassExists(object $class): bool
    {
        return array_key_exists($this->extractClassNameFromObject($class), $this->class);
    }

    protected function checkClassKeyExists(string $class): bool
    {
        return array_key_exists($class, $this->class);
    }

    public static function init(): object
    {
        if (empty(static::$self)) {
            static::$self = new self();
        }

        return static::$self;
    }
}
