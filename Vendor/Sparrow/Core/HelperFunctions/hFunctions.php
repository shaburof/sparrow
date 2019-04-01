<?php

function dd($data=null)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

