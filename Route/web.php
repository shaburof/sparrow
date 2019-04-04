<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', function () {
    render('welcome');
}, ['name' => 'welcome']);

Route::post('/post/test','UserController@user');

Route::get('/test', function () {

    $routerStore = getClass(\Vendor\Sparrow\Router\RouteStore::class);
    dd($routerStore);

}, ['name' => 'test']);


