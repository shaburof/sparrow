<?php

function dd($data)
{
    echo '<pre>';
    var_export($data);
    echo '</pre>';
    die();
}

function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}

