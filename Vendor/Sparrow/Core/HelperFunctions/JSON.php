<?php

function JSON(array $data): string
{
    return \Vendor\Sparrow\Core\Builder::sCreate(\Vendor\Sparrow\Core\JSON\handlerJson::class)->JSON($data);
}

function fromJSON(string $data):array
{
    return \Vendor\Sparrow\Core\Builder::sCreate(\Vendor\Sparrow\Core\JSON\handlerJson::class)->fromJSON($data);
}
