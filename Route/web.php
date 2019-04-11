<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);

Route::get('/test2', 'userController@user', ['name' => 'test2']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';
//
    $user=new \App\Model\User();
//
//    $user=$user->find(1)->first();
//    $user->name='new name2';
//    $user->save();
//    dd($user);
//    $userObject=(object)getVars($user);
//    $ser = serialize($userObject);
//    $userObject=unserialize($ser);
//
//
//    dd($userObject);
//    $login = new \Vendor\Sparrow\Login\Login();
//    dd($login->login('nata', 'pa$$word'));

    $login = new \Vendor\Sparrow\Login\Login();
    $login->login('nata@example.com', 'pa$$word');

    $auth=getClass(\Vendor\Sparrow\Auth\Auth::class);
//    dd();
    dd($auth);

//    dd($user);
//    $login = new \Vendor\Sparrow\Login\Login();
//    $login->login('nata@example.com', 'pa$$word');
//    dump($login->signUp(['name' => 'nata', 'email' => 'nata@example.com', 'password' => 'pa$$word']));
//    $login->logout();
//    dd($login);
}, ['name' => 'test']);


Route::post('/test', function () {

    $data = (new \App\Model\footable())->select()->all();

    return \Vendor\Sparrow\Core\Api\Api::run(\App\Api\fooapi::class, $data, 201, 'code 201');


});
