<?php

// [render('test.bar.foo')] get view file from Resource/Views/test/bar/foo.php
function render($view, $variables = [])
{
    $view = getClass(\Vendor\Sparrow\Views\View::class);
    $view->render($view, $variables);
}

function sanitize($data)
{
    $validate = getClass(\Vendor\Sparrow\Core\Validate::class);
    return $validate->cleaning($data);
}
