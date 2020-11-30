<?php declare(strict_types=1);

namespace Zablose\DotEnv;

class Env
{
    private static array $vars = [];
    private static array $arrays = [];

    public static function get($key, $default = null)
    {
        return self::$vars[strtoupper($key)] ?? $default;
    }

    public static function all(): array
    {
        return self::$vars;
    }

    public function read(string $path): self
    {
        $file = fopen($path, 'r');

        if ($file) {
            while (($line = fgets($file)) !== false) {
                if (strpos($line, '=') === false) {
                    continue;
                }
                [$n, $v] = explode('=', $line);
                $name = $this->parseVariableName($n);
                $key = $this->parseArrayKey($n, $name);
                $value = Value::parse($v, self::$vars);
                if (strlen($key)) {
                    self::$vars[$name][$key] = $value;
                } else {
                    self::$vars[$name] = $value;
                }
            }

            if (! feof($file)) {
                trigger_error('Reading of the file stopped before end of file.', E_USER_WARNING);
            }

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

    public function parseVariableName(string $name): string
    {
        foreach (self::$arrays as $array_name) {
            if (strpos($name, $array_name) !== false) {
                return strtoupper($array_name);
            }
        }

        return strtoupper(trim($name));
    }

    public function parseArrayKey(string $n, string $name): string
    {
        $key = str_replace($name.'_', '', $n);

        return $key !== $n ? trim($key) : '';
    }
}
