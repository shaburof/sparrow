<?php

$arr = [
    'title' => 'new title',
    'name' => 'new name'
];
$tempArray = null;
$tempParametersString = '';
$tempValuesString = '';

foreach (array_keys($arr) as $value) {
    $tempParametersString .= $value . ',';
    $tempValuesString .= $arr[$value] . ',';
}
$tempArray = ['parameters' => rtrim($tempParametersString,','), 'values' => rtrim($tempValuesString,',')];

var_dump($tempArray);
