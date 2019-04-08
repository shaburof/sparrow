<?php
echo '<pre>';



$date=new DateTime('now',new DateTimeZone('Asia/Yekaterinburg'));
var_dump($date->format('Y-m-d'));
var_dump($date->format('H:i'));
