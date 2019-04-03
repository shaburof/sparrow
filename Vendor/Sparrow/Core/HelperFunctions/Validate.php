<?php

function sanitizeString($string)
{
    $validate = getClass(\Vendor\Sparrow\Core\Validate::class);
    return $validate->sanitizeString($string);
}

function protectionFromTags($string)
{
    $validate = getClass(\Vendor\Sparrow\Core\Validate::class);
    return $validate->protectionFromTags($string);
}
function protectedFromQuotes($string)
{
    $validate = getClass(\Vendor\Sparrow\Core\Validate::class);
    return $validate->protectedFromQuotes($string);
}
