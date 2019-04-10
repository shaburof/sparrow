<?php

function request(): \Vendor\Sparrow\Core\Request\Request
{
    return getClass(\Vendor\Sparrow\Core\Request\Request::class);
}

function isJson(): bool
{
    return request()->isJsonRequest();
}