<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);


Route::get('/test', function () {
    echo '<h1>get route</h1>';



}, ['name' => 'test']);


