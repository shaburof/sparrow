<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 29.03.2019
 * Time: 13:47
 */

namespace Vendor\Sparrow\Core\Request;

use Vendor\Sparrow\Core\Validate;

class Request
{
    protected $validate;

    public function __construct()
    {
        $this->validate = getClass(Validate::class);
        $this->getDataFromRequest();
        $this->getDataFromJsonRequest();
    }

    protected function getDataFromRequest():void
    {
        if ($_GET) {
            $this->createProperty($_GET);

        } elseif ($_POST) {
            $this->createProperty($_POST);
        }
    }

    protected function getDataFromJsonRequest():void
    {
        if (file_get_contents('php://input')) {
            $data = json_decode(file_get_contents('php://input'));
            $this->createProperty($data);
        }
    }

    protected function createProperty($params):void
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $this->validate->cleaning($v);
        }
    }


}
