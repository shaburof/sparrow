<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2', 'UserController@user', ['name' => 'test2']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';

//    $footable = new \App\Model\footable();
//    $data = $footable->select()->all();


//    $data = \Vendor\Sparrow\Core\DB\DB::sraw(['select * from footable where id>=?', ['2']])->all();
    $data = \Vendor\Sparrow\Core\DB\DB::source('select * from footable where id>=? and name like ?',2,'%a')->all();
    // сделать запрос к базу более простым
    dd(\Vendor\Sparrow\Core\Api\Api::run(\App\Api\fooapi::class, $data));


    $login = getClass(\Vendor\Sparrow\Login\Login::class);
//    dump($login->signUp(['name' => 'Ola Ivanova2', 'email'=>'ola11@example.com','password' => 'pa$$word']));
//    dd($login->logoutWithoutRedirect());
//    dump($login->attemt('ola11@example.com', 'pa$$word'));
    $auth = getClass(\Vendor\Sparrow\Auth\Auth::class);
    dump($auth->check());
    dump($auth->user()->email);
    dd(frameworkSession());


//    dd($user);
//    $login = new \Vendor\Sparrow\Login\Login();
//    $login->login('nata@example.com', 'pa$$word');
//    dump($login->signUp(['name' => 'Kola', 'email' => 'kola@example.com', 'password' => 'pa$$word']));
//    dd($login);
}, ['name' => 'test']);


Route::post('/test', function () {

    $data = (new \App\Model\footable())->select()->all();

    return \Vendor\Sparrow\Core\Api\Api::run(\App\Api\fooapi::class, $data, 201, 'code 201');


}, ['middleware' => 'auth']);
