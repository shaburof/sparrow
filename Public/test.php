<?php
echo '<pre>';

$str='http://localhost:8008/test2/?/and/?';

var_dump(preg_match('~\?~',$str));
var_dump(preg_match_all('~\?~',$str));

$params=['a123','a789'];
foreach ($params as $param) {
    $str=preg_replace('~\?~',$param,$str,1);
}

var_dump($str);

