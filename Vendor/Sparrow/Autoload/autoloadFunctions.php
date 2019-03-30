<?php
loadFunctions();

function loadFunctions()
{
    $path = ROOT . '/Vendor/Sparrow/Core/HelperFunctions/';
    $files = scandir($path);
    $files = array_splice($files, 2);
    foreach ($files as $file) {
        if (file_exists($path . $file)) {
            require_once $path . $file;
        }
    }
}

