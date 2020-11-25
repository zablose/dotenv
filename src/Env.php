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
                self::$vars[$name] = $this->parseValue($value);
            }

            if (! feof($file)) {
                trigger_error('Reading of the file stopped before end of file.', E_USER_WARNING);
            }

            fclose($file);
        }

        return $this;
    }

    public static function get($key, $default = '')
    {
        return self::$vars[$key] ?? $default;
    }

    private function parseValue(string $value)
    {
        $value = $this->checkValueForVars($value);

        if ($value === 'true') {
            return true;
        }

        if ($value === 'false') {
            return false;
        }

        if (is_numeric($value)) {
            return strpos($value, '.') === false ? intval($value) : floatval($value);
        }

        return $value;
    }

    private function checkValueForVars(string $value)
    {
        $var_start = strpos($value, '${');
        $var_end = strpos($value, '}');
        while ($var_start !== false && $var_end !== false && $var_end > $var_start) {
            $var_name = strtolower(substr($value, $var_start + 2, $var_end - $var_start - 2));
            $var_value = $this->vars[$var_name] ?? 'undefined';
            $value = str_replace('${'.strtoupper($var_name).'}', $var_value, $value);
            $var_start = strpos($value, '${');
            $var_end = strpos($value, '}');
        }

        return $value;
    }
}
