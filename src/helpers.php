<?php

use Zablose\DotEnv\Env;

if (! function_exists('env')) {
    function env(string $key, $default = null)
    {
        return Env::get($key, $default);
    }
}
