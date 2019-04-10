<?php

function uri(): string
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->uri();
}

function domain(): string
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->domain();
}

function domainWithPort(): string
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->domainWithPort();
}

function userAgent(): string
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->userAgent();
}

function secure(): bool
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->secure();
}

function requestMethod(): string
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->requestMethod();
}

function url($url, $parameters = null): string
{
    return getClass(\Vendor\Sparrow\Core\Url::class)->url($url, $parameters);
}

function router(string $name, ?array $parameters = null, ?array $additionalParameters = null)
{
    $Router = getClass(\Vendor\Sparrow\Router\Router::class);
    $uri = $Router->getNamedRouterPath($name, $parameters)->uri;
    if (empty($uri)) throw new Exception('указанное имя в маршрутах не найдено');
    return url($uri, $additionalParameters);
}

function action(string $action, ?array $parameters = null, ?array $additionalParameters = null)
{
    $Router = getClass(\Vendor\Sparrow\Router\Router::class);
    $uri = $Router->getRouterPathByAction($action, $parameters)->uri;
    if (empty($uri)) throw new Exception('указанное действие в маршрутах не найдено');
    return url($uri, $additionalParameters);
}
