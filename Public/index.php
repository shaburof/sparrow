<?php
//try {
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../Start/Start.php';

getClass(\Vendor\Sparrow\Router\Router::class)->Start();

















//} catch (Error $e) {
//    echo errorRender($e);
//    echo 'some error here';
//}
