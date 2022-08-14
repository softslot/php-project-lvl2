<?php

namespace Differ\Formatters\PlainFormatter;

use function Functional\flatten;

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
        default => throw new \Exception("Invalid value type '{$valueType}'!"),
    };
}

/**
 * @throws \Exception
 */
function generatePlainOutput(array $tree, array $propertyNames): array
{
    $output = array_map(function ($child) use ($propertyNames): string|array {
        $name = implode('.', [...$propertyNames, $child['name']]);
        switch ($child['type']) {
            case 'added':
                $value = stringify($child['newValue']);
                $result = "Property '{$name}' was added with value: {$value}";
                break;
            case 'removed':
                $result = "Property '{$name}' was removed";
                break;
            case 'changed':
                $oldValue = stringify($child['oldValue']);
                $newValue = stringify($child['newValue']);
                $result = "Property '{$name}' was updated. From {$oldValue} to {$newValue}";
                break;
            case 'unchanged':
                $result = "";
                break;
            case 'nested':
                $result = generatePlainOutput($child['children'], [...$propertyNames, $child['name']]);
                break;
            default:
                throw new \Exception("Invalid node type: {$child['type']}");
        }

        return $result;
    }, $tree);

    $filteredOutput = array_filter($output);

    return flatten($filteredOutput);
}

/**
 * @throws \Exception
 */
function renderPlain(array $data): string
{
    return implode("\n", generatePlainOutput($data, []));
}
