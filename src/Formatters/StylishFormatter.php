<?php

namespace Differ\Formatters\StylishFormatter;

const INITIAL_INDENT_LENGTH = 4;

/**
 * @throws \Exception
 */
function format(array $tree, int $depth = 0): string
{
    $strings = array_map(static fn ($node) => generateStylishOutput($node, $depth), $tree);
    $indent = getIndent($depth);

    return implode("\n", ["{", ...$strings, "{$indent}}"]);
}

/**
 * @throws \Exception
 */
function generateStylishOutput(array $node, int $depth = 0): string
{
    $indent = getIndent($depth);
    $name = $node['name'];
    $type = $node['type'];
    $stringifiedOldValue = stringify($node['oldValue'], $depth);
    $stringifiedNewValue = stringify($node['newValue'], $depth);
    $stylishOutput = format($node['children'], $depth + 1);

    return match ($node['type']) {
        'added'     => "{$indent}  + {$name}: {$stringifiedNewValue}",
        'removed'   => "{$indent}  - {$name}: {$stringifiedOldValue}",
        'changed'   => implode("\n", [
            "{$indent}  - {$name}: {$stringifiedOldValue}",
            "{$indent}  + {$name}: {$stringifiedNewValue}",
        ]),
        'unchanged' => "{$indent}    {$name}: {$stringifiedOldValue}",
        'nested'    => rtrim("{$indent}    {$name}: {$stylishOutput}"),
        default     => throw new \RuntimeException("Unknown node type: '{$type}'"),
    };
}

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

    $stringifiedValue = array_map(static function ($value, $key) use ($depth, $indent) {
        $formattedValue = stringify($value, $depth);
        return "{$indent}    {$key}: {$formattedValue}";
    }, $normalizedValue, array_keys($normalizedValue));

    return implode("\n", ["{", ...$stringifiedValue, "{$indent}}"]);
}
