<?php
/**
 * Created by PhpStorm.
 * User: shaburov
 * Date: 04.04.2019
 * Time: 12:40
 */

function csrf(): string
{
    return getClass(\Vendor\Sparrow\Core\Csrf\Csrf::class)->getCsrf();
}
