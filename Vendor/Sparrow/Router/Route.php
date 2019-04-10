<?php

namespace Vendor\Sparrow\Router;

class Route
{
    protected function __construct($uri, $secondParameter)
    {
    }

    public static function get(string $uri, $action, array $parameters = []): void
    {
        static::Store([$uri, 'get', $action, $parameters]);
    }

    public static function post(string $uri, $action, array $parameters = []): void
    {
        static::Store([$uri, 'post', $action, $parameters]);
    }

    private static function Store(array $params): void
    {
        [$uri, $type, $action, $parameters] = $params;
        $path = (object)[
            'uri' => $uri === '/' ? '/' : trim($uri, '/'),
//            'uri' => trim($uri, '/'),
            'action' => !$action instanceof \Closure ? preg_replace('~\.~', '\\', $action) : $action,
            'type' => $type,
            'parameters' => (object)$parameters
        ];

        getClass(RouteStore::class)->add($path);
    }

}
