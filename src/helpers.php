<?php

use Zablose\DotEnv\Env;

if (! function_exists('env')) {
    function env(string $key, $default = null)
    {
        return Env::get($key, $default);
    }
}

if (! function_exists('env_float')) {
    function env_float(string $key, float $default = null): float
    {
        return Env::float($key, $default);
    }
}
