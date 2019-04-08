<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 03.04.2019
 * Time: 16:35
 */

namespace App\Controllers;


class UserController
{
    public function user($id)
    {
        render('welcome',compact('id'));
        echo "id is: $id, this is user method in UserController class";
    }

}
