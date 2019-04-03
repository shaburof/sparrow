<?php
//Use Vendor\blade\BladeOne;
try{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once '../Start/Start.php';

    render('welcome');

} catch (Error $e) {
    echo errorRender($e);
    echo 'some error here';
}
