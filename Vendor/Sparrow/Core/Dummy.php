<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 8:50
 */

namespace Vendor\Sparrow\Core;


class Dummy
{
    public $dummy = 'this is dummy class';

    public function __construct($string = null)
    {
        if (!empty($string)) $this->dummy = $string;
    }

    public function __toString()
    {
        return 'dummy class';
    }
}
