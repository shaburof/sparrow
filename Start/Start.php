<?php
const ROOT = __DIR__ . '/../';

require_once ROOT . 'Vendor/Sparrow/Autoload/autoload.php';
require_once ROOT . 'Vendor/Sparrow/Autoload/autoloadFunctions.php';

spl_autoload_register('\Vendor\Sparrow\Autoload\load');

mb_internal_encoding(env('CHARSET', 'UTF-8'));
mb_http_output(env('CHARSET', 'UTF-8'));

$views = ROOT . 'Resource/Views'; // it uses the folder /views to read the templates
$cache = ROOT . 'Store/Cache'; // it uses the folder /cache to compile the result.
setClass(new \Vendor\blade\BladeOne($views, $cache, \Vendor\blade\BladeOne::MODE_AUTO));

setClass(new \Vendor\Sparrow\Date\Date());

setClass(new \Vendor\Sparrow\Core\Session\Session());

setClass(new \Vendor\Sparrow\Core\Csrf\Csrf(60, 30));

setClass(new \Vendor\Sparrow\Core\Builder());
setClass(new \Vendor\Sparrow\Core\Validate());
setClass(new \Vendor\Sparrow\Core\Url());
setClass(new \Vendor\Sparrow\Core\Request\Request());
setClass(new \Vendor\Sparrow\Core\Response\Response());
setClass(new \Vendor\Sparrow\Views\View());

//setClass(new \Vendor\Sparrow\Core\DB\DB()); // :TODO убрал
//setClass(new \Vendor\Sparrow\Core\DBConnectors\MysqlConnector()); // :TODO убрал
setClass(\Vendor\Sparrow\Core\DBConnectors\BaseConnector::getDBConnentor(),'connector');


setClass(new \Vendor\Sparrow\Auth\Auth());

setClass(new \Vendor\Sparrow\Router\RouteStore());
require ROOT . 'Route/web.php';
setClass(new \Vendor\Sparrow\Router\Router());
