<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 03.04.2019
 * Time: 12:34
 */

namespace Vendor\Sparrow\Core;


class Url
{
    protected $global;

    public function __construct()
    {
        $this->global = $_SERVER;
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
}
