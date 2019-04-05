<?php
require 'Vendor/Sparrow/Console/Console.php';
use \Vendor\Sparrow\Console\Console;

new Console(array_splice($argv, 1));

//$br = PHP_EOL;
//$arguments = array_pop(array_splice($argv, 1));
//$commands = [
//    'create' => [
//        'auth' => 'auth'
//    ],
//    'help' => 'help'];
//$html = <<<HTML
//     SPARROW{$br}
//-----------------{$br}
//HTML;
//echo $html;
//
//[$method, $params] = explode(':', $arguments);
//
//function help()
//{
//    $html = <<<HTML
//create:auth   -   create auth table
//help          -   this help
//HTML;
//    echo $html;
//}
//
//function auth()
//{
//    echo 'auth method';
//}
//
//function stop()
//{
//    echo "command not found";
//    die();
//}
