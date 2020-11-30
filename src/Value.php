<?php declare(strict_types=1);

namespace Zablose\DotEnv;

class Value
{
    public static function parse(string $value, array $vars)
    {
        $value = Value::replaceVarsWithValues(Value::cleanValue($value), $vars);

        if ($value === 'true') {
            return true;
        }

        if ($value === 'false') {
            return false;
        }

        if (is_numeric($value)) {
            return strpos($value, '.') === false ? intval($value) : floatval($value);
        }

        if ($value === 'null') {
            return null;
        }

        return $value;
    }

    private static function replaceVarsWithValues(string $value, array $vars)
    {
        $var_start = strpos($value, '${');
        $var_end = strpos($value, '}');

        while ($var_start !== false && $var_end !== false && $var_end > $var_start) {
            $var_name = strtoupper(substr($value, $var_start + 2, $var_end - $var_start - 2));
            $var_value = $vars[$var_name] ?? 'undefined';
            $value = str_replace('${'.$var_name.'}', $var_value, $value);
            $var_start = strpos($value, '${');
            $var_end = strpos($value, '}');
        }

        return $value;
    }

    private static function cleanValue(string $value): string
    {
        return trim(trim($value), '"\'');
    }
}
