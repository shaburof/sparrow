<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 03.04.2019
 * Time: 12:34
 */

namespace Vendor\Sparrow\Core;


use Vendor\Sparrow\Router\Router;

class Url
{
    protected $global;
    protected $router;

    public function __construct()
    {
        $this->global = $_SERVER;

//        $this->router=Builder::sCreate(Router::class);
    }

    protected function get(string $item)
    {
        return !empty($this->global[$item]) ? $this->global[$item] : false;
    }

    public function uri(): string
    {
        return $this->get('REQUEST_URI');
    }

    public function domain(): string
    {
        return $this->get('SERVER_NAME');
    }

    public function domainWithPort(): string
    {
        return $this->get('HTTP_HOST');
    }

    public function userAgent(): string
    {
        return $this->get('HTTP_USER_AGENT');
    }

    public function secure(): bool
    {
        return $this->get('HTTPS');
    }

    public function requestMethod(): string
    {
        return $this->get('REQUEST_METHOD');
    }

    public function url(string $url, array $parameters = null): string
    {
        $addToUrl = sanitizeUrl(trim($url, '/'));
        $params = null;
        if ($parameters) {
            $params = '?';
            foreach ($parameters as $k => $v) {
                $params .= "$k=$v&";
            }
            $params = rtrim($params, '&');
        }
        $scheme = secure() ? 'https' : 'http';
        $domainWithPort = domainWithPort();
        $url = "{$scheme}://{$domainWithPort}/$addToUrl$params";

        return $url;
    }

    public function Route(string $route): string
    {

    }
}
