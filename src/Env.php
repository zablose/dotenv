<?php declare(strict_types=1);

namespace Zablose\DotEnv;

class Env
{
    private static array $vars = [];

    public function read(string $path): self
    {
        $file = fopen($path, 'r');

        if ($file) {
            while (($line = fgets($file)) !== false) {
                if (strpos($line, '=') === false) {
                    continue;
                }
                [$n, $v] = explode('=', $line);
                $name = strtoupper(trim($n));
                $value = trim(trim($v), '"\'');
                self::$vars[$name] = Value::parse($value, self::$vars);
            }

            if (! feof($file)) {
                trigger_error('Reading of the file stopped before end of file.', E_USER_WARNING);
            }

            fclose($file);
        }

        return $this;
    }

    public static function get($key, $default = null)
    {
        return self::$vars[strtoupper($key)] ?? $default;
    }

    public function reset(): self
    {
        self::$vars = [];

        return $this;
    }

    public static function all(): array
    {
        return self::$vars;
    }
}
