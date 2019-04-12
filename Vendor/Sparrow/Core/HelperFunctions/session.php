<?php

function session(): \Vendor\Sparrow\Core\Session\Session
{
    return getClass(\Vendor\Sparrow\Core\Session\Session::class);
}

function frameworkSession(): object
{
    return session()->frameworkSession();
}

