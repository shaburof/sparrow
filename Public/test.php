<?php
echo '<pre>';
function foo(...$a){
    var_dump($a);
}


foo(1,2,3);
