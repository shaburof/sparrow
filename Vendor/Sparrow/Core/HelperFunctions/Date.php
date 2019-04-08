<?php

function now($format=null){
    $Date = getClass(\Vendor\Sparrow\Date\Date::class);

    return $Date->now($format);
}
