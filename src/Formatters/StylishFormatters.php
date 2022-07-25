<?php

namespace Hexlet\Code\Formatters\StylishFormatter;

const INDENT_LENGTH = 4;

function getIndent(int $num): string
{
    return str_repeat(' ', INDENT_LENGTH * $num);
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
    $output = array_map(function ($node) use ($depth, $indent): string {

        list('name' => $name, 'status' => $status, 'oldValue' => $oldValue,
            'newValue' => $newValue, 'children' => $children) = $node;

        switch ($status) {
            case 'added':
                $formattedValue = stringify($newValue, $depth);
                return "{$indent}  + {$name}: {$formattedValue}";

            case 'removed':
                $formattedValue = stringify($oldValue, $depth);
                return "{$indent}  - {$name}: {$formattedValue}";

            case 'unchanged':
                $formattedValue = stringify($oldValue, $depth);
                return "{$indent}    {$name}: {$formattedValue}";

            case 'changed':
                $deleted = stringify($oldValue, $depth);
                $added = stringify($newValue, $depth);
                return "{$indent}  - {$name}: {$deleted}\n{$indent}  + {$name}: {$added}";

            case 'nested':
                $stylishOutput = render($children, $depth + 1);
                return "{$indent}    {$name}: {$stylishOutput}";

            default:
                throw new \Exception("Unknown node status '{$status}'!");
        }
    }, $tree);

    return implode("\n", ["{", ...$output, "{$indent}}"]);
}
