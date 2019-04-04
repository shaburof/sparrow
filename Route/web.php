<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', function () {
    render('welcome');
}, ['name' => 'welcome']);

Route::post('/post/test', 'UserController@user', ['name' => 'postTest']);

Route::get('/test', function () {

    dump(action('UserController@user',['foo'=>'bar']));

}, ['name' => 'test']);


