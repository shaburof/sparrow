<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);


Route::get('/test', function () {
    echo '<h1>get route</h1>';


    $footable = new \App\Model\footable();

    $data = $footable->update(['title' => 'fooBarBaz'])->where(function ($query) {
        $query->where('id', '=', '34');
    })->get();
//    dd($data);
//    $footable->find(31)->get();

//    $data = $footable->select(['id','name'])->where('id','>', '31')->all();
//    $data = $footable->select()->first();

//    $data = $footable->select()->where(function ($query) {
//        $query->where('name', '=', 'one name')->or()->where('name', '=', 'two name');
//    })->first();
//    $data = $footable->select()->where('id','=',31)->all();

//    dd($data->title);
}, ['name' => 'test']);


