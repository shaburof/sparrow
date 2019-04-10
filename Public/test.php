<?php
echo '<pre>';

$str='SELECT id FROM footable';

    $str=preg_replace('/select.+FROM/i','SELECT COUNT(*) as count FROM',$str);

var_dump($str);

