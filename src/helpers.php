<?php

use Zablose\DotEnv\Env;

if (! function_exists('env_float')) {
    function env_float(string $key, float $default = null): float
    {
        return Env::float($key, $default);
    }
}

if (! function_exists('env_int')) {
    function env_int(string $key, int $default = null): int
    {
        return Env::int($key, $default);
    }
}

if (! function_exists('env_string')) {
    function env_string(string $key, string $default = ''): string
    {
        return Env::string($key, $default);
    }
}

if (! function_exists('env_array')) {
    function env_array(string $key, array $default = []): array
    {
        return Env::array($key, $default);
    }
}

if (! function_exists('env_bool')) {
    function env_bool(string $key, bool $default = false): bool
    {
        return Env::bool($key, $default);
    }
}
