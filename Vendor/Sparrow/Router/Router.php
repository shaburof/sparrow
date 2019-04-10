<?php

namespace Vendor\Sparrow\Router;

use Vendor\Sparrow\Core\Errors\Errors;
use Vendor\Sparrow\Core\Validate;

class Router
{

    protected $routePaths;
    protected $uri;
    protected $validate;
    private $routerPattern = '/([0-9a-zA-Z-%]*)';

    public function __construct()
    {
        $this->routePaths = getClass(\Vendor\Sparrow\Router\RouteStore::class)->getPaths();
        $this->uri = trim(uri(), '/')===''?'/':trim(uri(), '/');
        $this->validate = getClass(Validate::class);
    }


    public function Start()
    {
        // ::TODO сделать вывод 404 ошибки если маршрут отсутствует
        $storedRouters = $this->filterBy('type', requestMethod());
        foreach ($storedRouters as $path) {
            $match = $this->compareUriWithStoredRoutes($this->removeGetParametersFromUri($this->uri), $path->uri);
            if ($match !== false) {
                ['parameters' => $parameters] = $match;
                $this->launchAction($path->action, $this->sanitizeParameters($parameters));
                return true;
            }
        }
        return 'false'; // :TODO зачем false в виде строки?
    }

    protected function sanitizeParameters(array $parameters): array
    {
        return $this->validate->cleanUriParameters($parameters);
    }

    protected function launchAction($action, $parameters)
    {
        if ($action instanceof \Closure) {
            echo call_user_func_array($action, $parameters);
        } elseif (is_string($action)) {
            [$controller, $method] = explode('@', $action);
            $controllerFullName = "\App\Controllers\\$controller";
            echo call_user_func_array([\Vendor\Sparrow\Core\Builder::sCreate($controllerFullName), $method], $parameters);
        }
    }


    protected function compareUriWithStoredRoutes($uri, $route)
    {
        $pattern = preg_replace('~(/\?)~', $this->routerPattern, $route);
        $pattern = "^$pattern$";
        if (preg_match("~$pattern~", $uri, $matchParameters) === 1) {
            return ['parameters' => array_splice($matchParameters, 1, count($matchParameters) - 1)];
        }
        return false;
    }

    protected function removeGetParametersFromUri(string $uri): string
    {
        return explode('?', $uri)[0];
    }

    protected function filterBy(string $type, string $value): ?array
    {
        $array = array_filter($this->routePaths, function ($item) use ($type, $value) {
            if (strtolower($item->$type) === strtolower($value)) return $item;
        });

        return count($array) > 0 ? $array : null;
    }

    public function getNamedRouterPath(string $name, ?array $parameters): ?object
    {
        foreach ($this->routePaths as $item) {
            if ($item->parameters->name === $name) {
                $this->changeQuestionMarksOnValue($item, $parameters);
                return $item;
            }
        }
        return null;
    }

    protected function changeQuestionMarksOnValue(object $route, ?array $parameters = null): object
    {
        if (empty($parameters)) return $route;

        $uri = $route->uri;
        $parametersCount = count($parameters);
        if (preg_match_all('~\?~', $uri) === $parametersCount) {
            foreach ($parameters as $param) {
                $route->uri=preg_replace('~\?~',$param,$route->uri,1);
            }
        } else {
            throw  new Errors('колличество параметров для маршрута не совпадает');
        }

        return $route;
    }

    public function getRouterPathByAction(string $action, ?array $parameters=null): ?object
    {
        foreach ($this->routePaths as $item) {
            if ($item->action === $action) {
                $this->changeQuestionMarksOnValue($item, $parameters);
                return $item;
            }
        }
        return null;
    }

}
