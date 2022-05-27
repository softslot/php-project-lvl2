<?php

namespace Hexlet\Code\Differ;

function genDiff($firstFile, $secondFile)
{
    $file1 = json_decode(file_get_contents($firstFile), true);
    $file2 = json_decode(file_get_contents($secondFile), true);

    $keys1 = array_keys($file1);
    $keys2 = array_keys($file2);
    $uniqueKeys = array_unique([...$keys1, ...$keys2]);
    sort($uniqueKeys);

    $symbols = ['add' => '+', 'delete' => '-', 'no change' => ' '];
    $data = [];
    foreach ($uniqueKeys as $key) {
        $value1 = $file1[$key] ?? null;
        $value2 = $file2[$key] ?? null;
        $normalizedValue1 = normalizeValue($value1);
        $normalizedValue2 = normalizeValue($value2);

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

function normalizeValue($value): string
{
    return match ($value) {
        false => 'false',
        true => 'true',
        null => 'null',
        default => $value,
    };
}
