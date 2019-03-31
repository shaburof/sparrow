<?php
//try {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once '../Start/Start.php';

//
//    $view = getClass(\Vendor\Sparrow\Views\View::class);
//    $title='new title';$arr=[1,2,3,4,5];
//    $view->render('welcome',compact('title','arr'));

dd(db()->raw('SELECT * from footable where id=?',['1'])->all());

//} catch (Error $e) {
//    echo errorRender($e);
//}
