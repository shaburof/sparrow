<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 04.04.2019
 * Time: 12:40
 */

function csrf(): string
{
    return getClass(\Vendor\Sparrow\Core\Csrf\Csrf::class)->getToken();
}

function csrf_field()
{
    return "<input type='hidden' name='csrf' value='" . csrf() . "'>";
}
