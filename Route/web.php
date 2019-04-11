<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2', 'userController@user', ['name' => 'test2']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';
//    dump(csrf());
//    dd(getClass(\Vendor\Sparrow\Core\Csrf\Csrf::class));
//    dump(request()->getHeaders());
    dd( (new \App\Model\footable())->select()->all());


}, ['name' => 'test']);


Route::post('/test', function () {

    return (new \App\Model\footable())->select()->all();
});
