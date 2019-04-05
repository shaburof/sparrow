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
    echo '<h1>get route</h1>';

    $token = csrf();

    $csrfClass = getClass(\Vendor\Sparrow\Core\Csrf\Csrf::class);

    $compare = $csrfClass->compare($token);

    dump($token);
    dump($compare);
    dump($_REQUEST);


}, ['name' => 'test']);


