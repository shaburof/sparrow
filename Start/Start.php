<?php
const ROOT = __DIR__ . '/../';

require_once '../Vendor/Sparrow/Autoload/autoload.php';
require_once '../Vendor/Sparrow/Autoload/autoloadFunctions.php';

spl_autoload_register('\Vendor\Sparrow\Autoload\load');

$views = ROOT . 'Resource/Views'; // it uses the folder /views to read the templates
$cache = ROOT . 'Store/Cache'; // it uses the folder /cache to compile the result.
setClass(new \Vendor\blade\BladeOne($views, $cache, \Vendor\blade\BladeOne::MODE_AUTO));

setClass(new \Vendor\Sparrow\Core\Session\Session());

setClass(new \Vendor\Sparrow\Core\Csrf\Csrf(2,60));

setClass(new \Vendor\Sparrow\Core\Builder());
setClass(new \Vendor\Sparrow\Core\Validate());
setClass(new \Vendor\Sparrow\Core\Url());
setClass(new \Vendor\Sparrow\Core\Request\Request());
setClass(new \Vendor\Sparrow\Views\View());
setClass(new \Vendor\Sparrow\Core\DB\DB());


setClass(new \Vendor\Sparrow\Router\RouteStore());
require ROOT.'Route/web.php';
setClass(new \Vendor\Sparrow\Router\Router());
