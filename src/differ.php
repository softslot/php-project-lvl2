<?php

namespace Hexlet\Code\Differ;

use function Hexlet\Code\Parsers\JsonParser\parse as parseJson;
use function Hexlet\Code\Parsers\YamlParser\parse as parseYaml;

/**
 * @throws \Exception
 */
function genDiff($firstFile, $secondFile)
{
    $file1 = getParser($firstFile);
    $file2 = getParser($secondFile);

    $keys1 = array_keys($file1);
    $keys2 = array_keys($file2);
    $uniqueKeys = array_unique([...$keys1, ...$keys2]);
    sort($uniqueKeys);

    $symbols = ['add' => '+', 'delete' => '-', 'no change' => ' '];
    $data = [];
    foreach ($uniqueKeys as $key) {
        $value1 = $file1[$key] ?? null;
        $value2 = $file2[$key] ?? null;
        $normalizedValue1 = toString($value1);
        $normalizedValue2 = toString($value2);

        if (isset($value1) && isset($value2)) {
            if ($value1 === $value2) {
                $data[] = "{$symbols['no change']} {$key} : {$normalizedValue1}";
            } else {
                $data[] = "{$symbols['delete']} {$key} : {$normalizedValue1}";
                $data[] = "{$symbols['add']} {$key} : {$normalizedValue2}";
            }
        } elseif (isset($value1)) {
            $data[] = "{$symbols['delete']} {$key} : {$normalizedValue1}";
        } else {
            $data[] = "{$symbols['add']} {$key} : {$normalizedValue2}";
        }
    }

    $str = implode("\n  ", $data);
    return "{\n  {$str}\n}\n";
}

function toString($value): string
{
    return trim(var_export($value, true), "'");
}

/**
 * @throws \Exception
 */
function getParser($filePath)
{
    ['extension' => $extension] = pathinfo($filePath);

    return match ($extension) {
        'json' => parseJson($filePath),
        'yml' => parseYaml($filePath),
        default => throw new \Exception('Undefended format!'),
    };
}
