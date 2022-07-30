<?php

namespace Hexlet\Code\Formatters\PlainFormatter;

use function Funct\Collection\flattenAll;

function stringify($value): string
{
    $valueType = gettype($value);
    return match ($valueType) {
        'NULL' => 'null',
        'string', 'boolean', 'integer', 'double' => var_export($value, true),
        'object', 'array' => '[complex value]',
        default => throw new \Exception("Invalid value type '{$valueType}'!"),
    };
}

function generatePlainOutput(array $tree, array $propertyNames): array
{
    $output = array_map(function ($child) use ($propertyNames): string {
        $name = implode('.', [...$propertyNames, $child['name']]);

        switch ($child['status']) {
            case 'added':
                $value = stringify($child['newValue']);
                return "Property '{$name}' was added with value: {$value}";

            case 'removed':
                return "Property '{$name}' was removed";

            case 'changed':
                $oldValue = stringify($child['oldValue']);
                $newValue = stringify($child['newValue']);
                return "Property '{$name}' was updated. From {$oldValue} to {$newValue}";

            case 'unchanged':
                return "";

            case 'nested':
                return generatePlainOutput($child['children'], [...$propertyNames, $child['name']]);

            default:
                throw new \Exception("Invalid node status: {$child['status']}");
        }
    }, $tree);

    return flattenAll(array_filter($output));
}

function renderPlain(array $data): string
{
    return implode("\n", generatePlainOutput($data, [])) . "\n";
}
