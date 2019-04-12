<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2', 'UserController@user', ['name' => 'test2']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';


    $footable = new \App\Model\footable();

    $data = $footable->select()->order('created_at','DESC')->all();


    foreach ($data as $item) {
        dump($item->name);
        dump($item->created_at);
    }



}, ['name' => 'test']);


Route::post('/test', function () {

    $data = (new \App\Model\footable())->select()->all();

    return \Vendor\Sparrow\Core\Api\Api::run(\App\Api\fooapi::class, $data, 201, 'code 201');


}, ['middleware' => 'auth']);
