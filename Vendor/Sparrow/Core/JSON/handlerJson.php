<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 10.04.2019
 * Time: 12:51
 */

namespace Vendor\Sparrow\Core\JSON;


class handlerJson
{

    public function JSON($data): string
    {
        return json_encode($data);
    }

    public function fromJSON(string $data)
    {
        return json_decode($data,true);
    }

}
