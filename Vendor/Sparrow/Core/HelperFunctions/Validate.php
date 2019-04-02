<?php

function sanitizeString($string)
{
    $validate = getClass(\Vendor\Sparrow\Core\Validate::class);
    return $validate->sanitizeString($string);
}
