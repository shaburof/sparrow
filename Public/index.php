<?php

use \Vendor\Sparrow\Core\Builder;

try {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Start/Start.php';

$footable = Builder::sCreate(\App\Model\footable::class);


$footable->update([
    'title'=>'edited'
])->query(function($q){
    $q->where('id','=','23')->or()->where('name','like','kola');
});

//dd($footable);
} catch (Error $e) {
    echo errorRender($e);
}
