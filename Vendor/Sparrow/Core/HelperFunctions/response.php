<?php

function response(int $code, string $message = null): void
{
    $response = getClass(\Vendor\Sparrow\Core\Response\Response::class);
    $response->setResponseCode($code, $message);
}
