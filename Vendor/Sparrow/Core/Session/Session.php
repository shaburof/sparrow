<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 04.04.2019
 * Time: 15:08
 */

namespace Vendor\Sparrow\Core\Session;


class Session extends SessionMain
{

    public function __get($name)
    {
        if (!empty($this->get($name))) {
            return $this->get($name);
        }
    }

    public function __set($name, $value)
    {
        $this->store($name, $value);
    }

    public function frameworkSession()
    {
        return $this->frameworkSession;
    }

}
