<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 8:24
 */

namespace Vendor\Sparrow\Core;


class App
{

    public function __call($name, $arguments)
    {
        var_dump($name);
        var_dump($arguments);
    }


}
