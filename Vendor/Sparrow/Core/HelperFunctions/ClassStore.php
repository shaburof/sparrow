<?php

function classStore()
{
    return \Vendor\Sparrow\Core\ClassStore::init();
}

// get class from classStore, [getClass(\Vendor\Sparrow\Views\View::class)]
function getClass($class)
{
    return classStore()->get($class);
}

// аналогично getClass()
function setClass($class, string $storeName = null)
{
    return classStore()->set($class, $storeName);
}

