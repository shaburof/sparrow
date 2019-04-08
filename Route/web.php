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

//    $footable = \Vendor\Sparrow\Core\Builder::sCreate(\App\Model\footable::class);
//    $footable->find(31);         //find
//    $footable->update([
//        'title'=>'edited'
//    ]);
//dd();


    $user = \Vendor\Sparrow\Core\Builder::sCreate(\App\Model\User::class);

//    $user->find(1);
//    $user->update([
//        'name'=>'Kola Ivanov'
//    ]);
    $user->insert([
        'name'=>'Ola Ivanova',
        'email'=>'ola@example.com',
        'password'=>'12345'
    ]);
//    dd($data);

//    $db = \Vendor\Sparrow\Core\Builder::sCreate(\Vendor\Sparrow\Core\DB\DB::class);
//    dump($db->fieldIsExist('created_at', 'user'));
//    dd($db->tableIsExist('user'));


}, ['name' => 'test']);


