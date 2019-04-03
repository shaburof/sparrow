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
