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
    dump(request()->foo ?? 'empty foo');

}, ['name' => 'postTest']);

Route::get('/test', function () {
    echo '<h1>get route</h1>';

    $footable = \Vendor\Sparrow\Core\Builder::sCreate(\App\Model\footable::class);

    $footable->select()->query(function ($q) {
        $q->where('id', '>=', 26);
    })->first();
    $footable->delete();

//    $footable->delete();
//    dump($footable->queryBuilder);

//    dump($data->title);
//    dd($footable->alredySeleted);

//    dump($footable->queryBuilder);
//    $data = $footable->update([
//        'title'=> 'edited 6'
//    ])->query(function($q){
//        $q->where('Id','=','21');
//    });

//    $footable->find(21)->update([
//        'title'=> 'edited 8'
//    ])->query(function($q){
//        $q->where('Id','=','21');
//    });

}, ['name' => 'test']);


