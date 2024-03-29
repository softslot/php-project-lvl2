<?php

namespace Differ\Formatters\PlainFormatter;

use function Functional\flatten;

/**
 * @throws \Exception
 */
function format(array $data): string
{
    return implode("\n", generatePlainOutput($data, []));
}

/**
 * @throws \Exception
 */
function generatePlainOutput(array $tree, array $propertyNames): array
{
    $output = array_map(static function ($child) use ($propertyNames): string|array {
        $name = implode('.', [...$propertyNames, $child['name']]);
        $stringifiedOldValue = stringify($child['oldValue']);
        $stringifiedNewValue = stringify($child['newValue']);

        return match ($child['type']) {
            'added'     => "Property '{$name}' was added with value: {$stringifiedNewValue}",
            'removed'   => "Property '{$name}' was removed",
            'changed'   => "Property '{$name}' was updated. From {$stringifiedOldValue} to {$stringifiedNewValue}",
            'unchanged' => '',
            'nested'    => generatePlainOutput($child['children'], [...$propertyNames, $child['name']]),
            default     => throw new \Exception("Invalid node type: '{$child['type']}'"),
        };
    }, $tree);

    $filteredOutput = array_filter($output);

    return flatten($filteredOutput);
}

/**
 * @throws \Exception
 */
function stringify(mixed $value): string
{
    $valueType = gettype($value);
    return match ($valueType) {
        'NULL' => 'null',
        'string', 'boolean', 'integer', 'double' => var_export($value, true),
        'object', 'array' => '[complex value]',
        default => throw new \Exception("Invalid value type: '{$valueType}'"),
    };
}
