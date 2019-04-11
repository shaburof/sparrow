<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2/?', 'userController@user', ['name' => 'test2']);

Route::get('/test', function () {
//    echo '<h1>get route</h1>';



    $data = (new \App\Model\footable())->select()->where(function ($query) {
        $query->where('id', '=', 1)->or()->where('id', '=', 3);
    })->all();

    dd(\Vendor\Sparrow\Core\Api\Api::run(\App\Api\fooapi::class, $data, 201, 'code 201'));


//    return dd(\Vendor\Sparrow\Core\Api\Api::sendApi(\App\Api\fooapi::class,$data,200,'good response'));


}, ['name' => 'test']);


Route::post('/test', function () {


    $data = (new \App\Model\footable())->select()->where(function ($query) {
        $query->where(2)->or()->where(3);
    })->all();

    return \Vendor\Sparrow\Core\Api\Api::run(\App\Api\fooapi::class, $data, 201, 'code 201');


});
