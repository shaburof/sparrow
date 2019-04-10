<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2/?/www/?','userController@user',['name'=>'test2']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';

    $footable = (new \App\Model\footable())->select()->all();

   dd(JSON($footable));

}, ['name' => 'test']);


