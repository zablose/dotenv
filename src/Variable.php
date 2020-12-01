<?php declare(strict_types=1);

namespace Zablose\DotEnv;

class Variable
{
    public static function getName(string $n, array $arrays): string
    {
        foreach ($arrays as $array_name) {
            if (strpos($n, $array_name) !== false) {
                return strtoupper($array_name);
            }
        }

        return strtoupper(trim($n));
    }

    public static function getArrayKey(string $n, string $name): string
    {
        $key = str_replace($name.'_', '', $n);

        return $key !== $n ? trim($key) : '';
    }

    public static function getValue(string $value, array $vars)
    {
        $value = Variable::replaceVarsWithValues($value, $vars);

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
        $value = trim(trim($value), '"\'');

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
}
