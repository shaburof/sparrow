<?php

function errorRender($e){
    $errorMessageRender = <<< HTML
<pre>
<h1 style='color: red'>error, code: {$e->getCode()}</h1>
текст ошибки: <b>{$e->getMessage()}</b>
код ошибки: <b>{$e->getCode()}</b>
в строке: <b>{$e->getLine()}</b>
вызвано в файле: <b>{$e->getFile()}</b>

<hr>
<h3 style='color: green;'>стек ошибки</h3>
HTML;
    foreach ($e->getTrace() as $item) {
        $errorMessageRender.="<p>текст ошибки: <b>".@$item['file']."</b></p>";
        $errorMessageRender.= "<p>в строке: <b>".@$item['line']."</b></p>";
        $errorMessageRender.= "<p>функция: <b>".@$item['function']."</b></p>";
        $errorMessageRender.= "<p>класс: <b>".@$item['class']."</b></p>";
        $errorMessageRender.= "<p>аргументы:" . @implode($item['args']) . "</p>";
        $errorMessageRender.= '-------------------------------------------------';
    }
    $errorMessageRender.= "</pre>";

    return $errorMessageRender;
}
