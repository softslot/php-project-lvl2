<?php

namespace Hexlet\Code\Formatters\StylishFormatter;

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

    $stringifiedValue = array_map(function ($value, $key) use ($depth, $indent): string {
        $formattedValue = stringify($value, $depth);
        return "{$indent}    {$key}: {$formattedValue}";
    }, $normalizedValue, array_keys($normalizedValue));

    return implode("\n", ["{", ...$stringifiedValue, "{$indent}}"]);
}

function render(array $tree, int $depth = 0)
{
    $indent = getIndent($depth);

    $fn = function ($node) use ($depth, $indent): string {
        ['name' => $name, 'status' => $status, 'oldValue' => $oldValue,
            'newValue' => $newValue, 'children' => $children] = $node;

        switch ($status) {
            case 'added':
                $formattedValue = stringify($newValue, $depth);
                return rtrim("{$indent}  + {$name}: {$formattedValue}");
            case 'removed':
                $formattedValue = stringify($oldValue, $depth);
                return rtrim("{$indent}  - {$name}: {$formattedValue}");
            case 'unchanged':
                $formattedValue = stringify($oldValue, $depth);
                return rtrim("{$indent}    {$name}: {$formattedValue}");
            case 'changed':
                $formattedOldValue = stringify($oldValue, $depth);
                $formattedNewValue = stringify($newValue, $depth);
                $parts = [
                    rtrim("{$indent}  - {$name}: {$formattedOldValue}"),
                    rtrim("{$indent}  + {$name}: {$formattedNewValue}"),
                ];
                return implode("\n", $parts);
            case 'nested':
                $stylishOutput = render($children, $depth + 1);
                return rtrim("{$indent}    {$name}: {$stylishOutput}");
            default:
                throw new \RuntimeException("Unknown node status '{$status}'!");
        }
    };

    return implode("\n", ["{", ...array_map($fn, $tree), "{$indent}}"]);
}
