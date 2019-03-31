<?php

function env($value, $default = null)
{
    $parseEnvFile = parse_ini_file(ROOT.'.env');
    return $parseEnvFile[strtoupper($value)] ?? $parseEnvFile[strtolower($value)] ?? $default;
}
