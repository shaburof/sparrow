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

    dump($_REQUEST);

}, ['name' => 'postTest']);

Route::get('/test', function () {

    $c = \Vendor\Sparrow\Core\Builder::sCreate(\Vendor\Sparrow\Console\Console::class);
    dd($c);

}, ['name' => 'test']);


