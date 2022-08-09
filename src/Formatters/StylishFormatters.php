<?php

namespace Differ\Formatters\StylishFormatter;

const INITIAL_INDENT_LENGTH = 4;

function getIndent(int $num): string
{
    return str_repeat(' ', INITIAL_INDENT_LENGTH * $num);
}

function stringify($value, $depth)
{
    $valueType = gettype($value);
    return match ($valueType) {
        'string' => $value,
        'NULL' => 'null',
        'boolean', 'integer', 'double' => var_export($value, true),
        'object', 'array' => stringifyComplexValue($value, $depth + 1),
        default => throw new \Exception("Invalid value type '{$valueType}'!"),
    };
}

function stringifyComplexValue($complexValue, $depth)
{
    $normalizedValue = is_object($complexValue) ? get_object_vars($complexValue) : $complexValue;

    $indent = getIndent($depth);

    $stringifiedValue = array_map(function ($value, $key) use ($depth, $indent) {
        $formattedValue = stringify($value, $depth);
        return "{$indent}    {$key}: {$formattedValue}";
    }, $normalizedValue, array_keys($normalizedValue));

    return implode("\n", ["{", ...$stringifiedValue, "{$indent}}"]);
}

function renderStylish(array $tree, int $depth = 0)
{
    $indent = getIndent($depth);

    $fn = function ($node) use ($depth, $indent): string {
        switch ($node['status']) {
            case 'added':
                $formattedValue = stringify($node['newValue'], $depth);
                $result = "{$indent}  + {$node['name']}: {$formattedValue}";
                break;
            case 'removed':
                $formattedValue = stringify($node['oldValue'], $depth);
                $result = "{$indent}  - {$node['name']}: {$formattedValue}";
                break;
            case 'changed':
                $formattedOldValue = stringify($node['oldValue'], $depth);
                $formattedNewValue = stringify($node['newValue'], $depth);
                $parts = [
                    "{$indent}  - {$node['name']}: {$formattedOldValue}",
                    "{$indent}  + {$node['name']}: {$formattedNewValue}",
                ];
                $result = implode("\n", $parts);
                break;
            case 'unchanged':
                $formattedValue = stringify($node['oldValue'], $depth);
                $result = "{$indent}    {$node['name']}: {$formattedValue}";
                break;
            case 'nested':
                $stylishOutput = renderStylish($node['children'], $depth + 1);
                $result = rtrim("{$indent}    {$node['name']}: {$stylishOutput}");
                break;
            default:
                throw new \RuntimeException("Unknown node status '{$node['status']}'!");
        }

        return $result;
    };

    return implode("\n", ["{", ...array_map($fn, $tree), "{$indent}}"]) . "\n";
}
