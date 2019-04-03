<?php

namespace Vendor\Sparrow\Router;

use Vendor\Sparrow\Core\Validate;

class Router
{

    protected $routePaths;
    protected $uri;
    protected $validate;

    public function __construct()
    {
        $this->routePaths = getClass(\Vendor\Sparrow\Router\RouteStore::class)->getPaths();
        $this->uri = trim(uri(), '/');
        $this->validate = getClass(Validate::class);
    }


    public function Start()
    {
        $storedRouters = $this->filterBy('type', requestMethod());
        foreach ($storedRouters as $path) {
            $match = $this->compareUriWithStoredRoutes($this->uri, $path->uri);

            if ($match !== false) {
                ['parameters' => $parameters] = $match;
                $this->launchAction($path->action, $this->sanitizeParameters($parameters));
                return true;
            }
        }
        return 'false';
    }

    protected function sanitizeParameters(array $parameters): array
    {
        return $this->validate->cleanUriParameters($parameters);
    }

    protected function launchAction($action, $parameters)
    {
        if ($action instanceof \Closure) {
            call_user_func_array($action, $parameters);
        } elseif (is_string($action)) {
            [$controller, $method] = explode('@', $action);
            $controllerFullName = "\App\Controllers\\$controller";
            call_user_func_array([\Vendor\Sparrow\Core\Builder::sCreate($controllerFullName), 'user'], $parameters);
        }
    }


    protected function compareUriWithStoredRoutes($uri, $route)
    {
        $pattern = preg_replace('~(/\?)~', '/([0-9a-zA-Z]*)', $route);
        $pattern = "^$pattern$";
        if (preg_match("~$pattern~", $uri, $matchParameters) === 1) {
            return ['parameters' => array_splice($matchParameters, 1, count($matchParameters) - 1)];
        }
        return false;
    }


    protected function filterBy(string $type, string $value): ?array
    {
        $array = array_filter($this->routePaths, function ($item) use ($type, $value) {
            if (strtolower($item->$type) === strtolower($value)) return $item;
        });

        return count($array) > 0 ? $array : null;
    }

    protected function getNamedRouterPath(string $name): ?object
    {
        foreach ($this->routePaths as $item) {
            if ($item->parameters->name === $name) {
                return $item;
            }
        }
        return null;
    }

}
