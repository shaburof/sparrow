<?php

use Vendor\Sparrow\Router\Route;


Route::get('/', 'welcomeController@index', ['name' => 'welcome']);


Route::get('/test', function () {
    echo '<h1>get route</h1>';


    $footable = new \App\Model\footable();
    $footable->insert([
        'title' => 'foo',
        'description' => 'bar',
        'name' => 'Ola Ivanova'
    ]);
//    dd(new \DateTime('now', new \DateTimeZone(env('TIMEZONE'))));
//dd(now());
//    $footable->find(31)->delete();
//    $footable->update(['title'=>'new title']);
//    $footable->find(98);
//    $footable->update(['title' => 'new title abc'])->where(98)->execute();

//    dd($footable->select()->where(98)->first()->name);
//    $footable->update(['title'=>'updated title']);
//    $footable->find(31)->update(['title'=>'updated title']);
//    $footable->select()->where(32)->delete();
//    $footable->select()->where(function($query){
//        $query->where('id','=',31)->or()->where('id','=',32);
//    })->delete();

//    dump($data);
    dd($footable->queryBuilder);

//    $footable->insert([
//        'title' => 'foo',
//        'description' => 'bar',
//        'name' => 'Ola Ivanova'
//    ]);
//    $data = $footable->update(['title' => 'fooBarBaz3'])->where(function ($query) {
//        $query->where('id', '>', '1');
//    })->execute();
//    dd($data);
//    $footable->find(31)->get();

//    $data = $footable->select(['id','name'])->where('id','>', '1')->all();
//dd($data);
    //    $data = $footable->select()->first();

//    $data = $footable->select()->where(function ($query) {
//        $query->where('name', '=', 'one name')->or()->where('name', '=', 'two name');
//    })->first();
//    $data = $footable->select()->where('id','=',31)->all();

//    dd($data->title);
}, ['name' => 'test']);


