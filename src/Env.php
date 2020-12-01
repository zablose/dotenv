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
                $name = Variable::getName($n, self::$arrays);
                $key = Variable::getArrayKey($n, $name);
                $value = Variable::getValue($v, self::$vars);
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
}
