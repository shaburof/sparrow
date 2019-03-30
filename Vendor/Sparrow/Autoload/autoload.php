<?php

namespace Vendor\Sparrow\Autoload;
//require_once ROOT . '/Vendor/Sparrow/Core/HelperFunctions/hFunctions.php';

function load($class)
{
    $classFileName = ROOT . preg_replace('/\\\\/', '/', $class) . '.php';
    if (is_file($classFileName) && file_exists($classFileName)) {
        require_once $classFileName;
    } else {
        echo "<h1>Class: <span style='color: red;'>$class</span> not found</h1>";
    }
}

