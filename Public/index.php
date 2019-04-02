<?php
//Use Vendor\blade\BladeOne;
try{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once '../Start/Start.php';

    $foo='bar';
    render('test.bar.foo');

//    include ROOT."Vendor/blade/BladeOne.php"; // you should change it and indicates the correct route.


//    $views = ROOT . 'Resource/Views'; // it uses the folder /views to read the templates
//    $cache = ROOT . 'Store/Cache'; // it uses the folder /cache to compile the result.
//    $blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);
//    echo $blade->run("test.bar.foo",array("title"=>"value1")); // /views/hello.blade.php must exist

} catch (Error $e) {
    echo errorRender($e);
    echo 'some error here';
}
