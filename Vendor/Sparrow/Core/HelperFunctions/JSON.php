<?php

function JSON($data): string
{
    return \Vendor\Sparrow\Core\Builder::sCreate(\Vendor\Sparrow\Core\JSON\handlerJson::class)->JSON($data);
}

function fromJSON(string $data)
{
    return \Vendor\Sparrow\Core\Builder::sCreate(\Vendor\Sparrow\Core\JSON\handlerJson::class)->fromJSON($data);
}
