<?php

use \Vendor\Sparrow\Core\DB\QueryBuilder;
use \Vendor\Sparrow\Core\Builder;

//try {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Start/Start.php';

//
//    $view = getClass(\Vendor\Sparrow\Views\View::class);
//    $title='new title';$arr=[1,2,3,4,5];
//    $view->render('welcome',compact('title','arr'));

//dd(db()->raw('SELECT * from footable')->first());
//

//dd(db()->raw(['select * from footable where id >= ?',[1]])->all());

$m = new \App\Model\footable();
$foo = $m->query(function ($q) {
    $q->select()->where('id','=',1)->or()->where('id','=',3);
})->all();
foreach ($foo as $item){
    echo "$item->title<br>";
}

//dd($m->query(function($queryBuilder){
//    $queryBuilder->select('title')->where('id','=',2);
//})->first());
// $m->query(function($q){
//     $q->select('title')   })->first();

//    $b = Builder::sCreate(QueryBuilder::class, false, 'footable');
//    dd($b->select('title')->build());

//    $db=Builder::sCreate(\Vendor\Sparrow\Core\DB\DB::class);
//    dd($db);


//} catch (Error $e) {
//    echo errorRender($e);
//}
