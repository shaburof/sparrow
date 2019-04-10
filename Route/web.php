<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2/?','userController@user',['name'=>'test2']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';

    return router('welcome');
    return router('test');

}, ['name' => 'test']);


