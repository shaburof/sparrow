<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 11.04.2019
 * Time: 10:31
 */

namespace App\Api;


use Vendor\Sparrow\Core\Api\Api;

class fooraw extends Api
{

    protected function Prepare($data)
    {
        return [
            'fullName'=>$data->name,
            'description'=>$data->description,
            'create'=>'дата создания'
        ];
    }
}
