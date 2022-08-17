<?php

namespace Differ\Formatters\StylishFormatter;

const INITIAL_INDENT_LENGTH = 4;

function getIndent(int $num): string
{
    return str_repeat(' ', INITIAL_INDENT_LENGTH * $num);
}

/**
 * @throws \Exception
 */
function stringify(mixed $value, int $depth): mixed
{
    $valueType = gettype($value);
    return match ($valueType) {
        'string' => $value,
        'NULL' => 'null',
        'boolean', 'integer', 'double' => var_export($value, true),
        'object', 'array' => stringifyComplexValue($value, $depth + 1),
        default => throw new \Exception("Invalid value type: '{$valueType}'"),
    };
}

/**
 * @throws \Exception
 */
function stringifyComplexValue(mixed $complexValue, int $depth): string
{
    $normalizedValue = is_object($complexValue) ? get_object_vars($complexValue) : $complexValue;

    $indent = getIndent($depth);

    $stringifiedValue = array_map(function ($value, $key) use ($depth, $indent) {
        $formattedValue = stringify($value, $depth);
        return "{$indent}    {$key}: {$formattedValue}";
    }, $normalizedValue, array_keys($normalizedValue));

    return implode("\n", ["{", ...$stringifiedValue, "{$indent}}"]);
}

/**
 * @throws \Exception
 */
function renderStylish(array $tree, int $depth = 0): string
{
    $indent = getIndent($depth);

    $fn = function ($node) use ($depth, $indent): string {
        switch ($node['type']) {
            case 'added':
                $formattedValue = stringify($node['newValue'], $depth);
                return "{$indent}  + {$node['name']}: {$formattedValue}";
            case 'removed':
                $formattedValue = stringify($node['oldValue'], $depth);
                return "{$indent}  - {$node['name']}: {$formattedValue}";
            case 'changed':
                $formattedOldValue = stringify($node['oldValue'], $depth);
                $formattedNewValue = stringify($node['newValue'], $depth);
                $parts = [
                    "{$indent}  - {$node['name']}: {$formattedOldValue}",
                    "{$indent}  + {$node['name']}: {$formattedNewValue}",
                ];
                return implode("\n", $parts);
            case 'unchanged':
                $formattedValue = stringify($node['oldValue'], $depth);
                return "{$indent}    {$node['name']}: {$formattedValue}";
            case 'nested':
                $stylishOutput = renderStylish($node['children'], $depth + 1);
                return rtrim("{$indent}    {$node['name']}: {$stylishOutput}");
            default:
                throw new \RuntimeException("Unknown node type: '{$node['type']}'");
        }
    };

    return implode("\n", ["{", ...array_map($fn, $tree), "{$indent}}"]);
}
