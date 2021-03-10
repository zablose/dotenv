<?php declare(strict_types=1);

namespace Zablose\DotEnv;

class Env
{
    private static array $vars = [];
    private static array $arrays = [];

    public static function get(string $key, $default = null)
    {
        return self::$vars[$key] ?? $default;
    }

    public static function all(): array
    {
        return self::$vars;
    }

    public static function float(string $key, float $default = null): float
    {
        return Env::get($key, $default);
    }

    public static function int(string $key, int $default = null): int
    {
        return Env::get($key, $default);
    }

    public static function string(string $key, string $default = null): string
    {
        return Env::get($key, $default);
    }

    public function read(string $path): self
    {
        $file = fopen($path, 'r');

        if ($file) {
            while (($line = fgets($file)) !== false) {
                if (strpos($line, '=') === false) {
                    continue;
                }
                [$raw_name, $raw_value] = explode('=', $line);
                $variable = Variable::make($raw_name, $raw_value, self::$arrays, self::$vars);
                if ($variable->is_array) {
                    self::$vars[$variable->name][$variable->array_key] = $variable->value;
                } else {
                    self::$vars[$variable->name] = $variable->value;
                }
                unset($variable);
            }

            // @codeCoverageIgnoreStart
            if (! feof($file)) {
                trigger_error('Reading of the file stopped before end of file.', E_USER_WARNING);
            }
            // @codeCoverageIgnoreEnd

            fclose($file);
        }

        return $this;
    }

    public function reset(): self
    {
        self::$vars = [];
        self::$arrays = [];

        return $this;
    }

    public function setArrays(array $arrays): self
    {
        self::$arrays = $arrays;

        return $this;
    }
}
