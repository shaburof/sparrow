<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);


Route::get('/csrf', function () {
    render('test');
});

Route::post('/test', function () {
    echo '<h1>post route</h1>';
    dump(request()->foo ?? 'empty foo');

}, ['name' => 'postTest']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';

//    $user = \Vendor\Sparrow\Core\Builder::sCreate(\App\Model\User::class);

//    $user->name='new name';
//    $user->email='new@example.com';
//    $user->find(2);
//    $user->delete();
//   $data = $user->find(3);
//   dd($data);
//   dd($data->update(['name'=>'Kola Ivanov 3','email'=>'kola@example.com']));
//   $user->update(['name'=>'Kola Ivanov 2','email'=>'kola@example.com']);



}, ['name' => 'test']);


