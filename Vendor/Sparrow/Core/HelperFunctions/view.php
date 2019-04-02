<?php

// [render('test.bar.foo')] get view file from Resource/Views/test/bar/foo.php
function render($view, $variables = [], $sanitize = false)
{
    $viewClass = getClass(\Vendor\Sparrow\Views\View::class);
    $viewClass->render($view, $variables,$sanitize);
}

function sanitize($data)
{
    $validate = getClass(\Vendor\Sparrow\Core\Validate::class);
    return $validate->cleaning($data);
}
