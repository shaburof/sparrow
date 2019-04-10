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
    public function user($a,$b)
    {

//        return router('test2',[$a,$b]);
        return action('userController@user',[$a,$b]);
//        return router('test2',['qwe'=>'asd']);
        return render('test');
    }

}
