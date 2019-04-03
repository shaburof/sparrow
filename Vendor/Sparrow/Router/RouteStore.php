<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 03.04.2019
 * Time: 11:53
 */

namespace Vendor\Sparrow\Router;


class RouteStore
{
    protected $paths = [];

    public function add(object $value): void
    {
        array_push($this->paths, $value);
    }

    public function getPaths(): array
    {
        return $this->paths;
    }

}
