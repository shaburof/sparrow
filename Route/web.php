<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', function () {
    render('welcome');
}, ['name' => 'welcome']);


Route::get('/csrf', function () {
    render('test');
});

Route::post('/test', function () {
    echo '<h1>post route</h1>';
    dump(request()->foo);

}, ['name' => 'postTest']);

Route::get('/test', function () {

    echo '<h1>get route</h1>';
    dump(csrf());
    dump(request()->foo);

}, ['name' => 'test']);


