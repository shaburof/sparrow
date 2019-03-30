<?php

const ROOT = __DIR__ . '/../';
require_once '../Vendor/Sparrow/Autoload/autoload.php';
require_once '../Vendor/Sparrow/Autoload/autoloadFunctions.php';

spl_autoload_register('\Vendor\Sparrow\Autoload\load');

setClass(new \Vendor\Sparrow\Core\Builder());
setClass(new \Vendor\Sparrow\Core\Validate());
setClass(new \Vendor\Sparrow\Core\Request\Request());
setClass(new \Vendor\Sparrow\Views\View());



//setClass(new \Vendor\Sparrow\Core\Dummy());

