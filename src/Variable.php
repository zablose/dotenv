<?php

declare(strict_types=1);

namespace Zablose\DotEnv;

class Variable
{
    public string $name = '';
    public bool $is_array = false;
    public string $array_key = '';
    public string|int|bool|float $value = '';

    public static function make(string $raw_name, string $raw_value, array $arrays, array $vars): self
    {
        $var_name = trim($raw_name);

        $variable = new Variable();
        $variable->name = $var_name;

        foreach ($arrays as $array_name) {
            if (str_starts_with($var_name, $array_name.'_')) {
                $variable->is_array = true;
                $variable->name = $array_name;
                $variable->array_key = str_replace($array_name.'_', '', $var_name);
                break;
            }
        }

        $variable->value = Variable::getValue($raw_value, $vars);

        return $variable;
    }

    private static function getValue(string $value, array $vars): string|int|bool|float
    {
        $value = Variable::replaceVarsWithValues($value, $vars);

        if ($value === 'true') {
            return true;
        }

        if ($value === 'false') {
            return false;
        }

        if (is_numeric($value)) {
            return str_contains($value, '.') ? floatval($value) : intval($value);
        }

        return $value;
    }

    private static function replaceVarsWithValues(string $value, array $vars): string
    {
        $value = trim(trim($value), '"\'');

        $var_start = strpos($value, '${');
        $var_end = strpos($value, '}');

        while ($var_start !== false && $var_end !== false && $var_end > $var_start) {
            $var_name = substr($value, $var_start + 2, $var_end - $var_start - 2);
            $var_value = (string) ($vars[$var_name] ?? 'undefined');
            $value = str_replace('${'.$var_name.'}', $var_value, $value);
            $var_start = strpos($value, '${');
            $var_end = strpos($value, '}');
        }

        return $value;
    }
}
