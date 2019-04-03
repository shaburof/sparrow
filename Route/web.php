<?php
use Vendor\Sparrow\Router\Route;



Route::get('/','UserController@main',['name'=>'main']);
Route::get('/user/?','UserController@user',['name'=>'user']);
Route::get('/user/?/?',function($a,$b){
    var_dump("$a and $b");
},['name'=>'closure']);


