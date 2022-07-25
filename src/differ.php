<?php

namespace Hexlet\Code\Differ;

use function Hexlet\Code\Parsers\parseDate;
use function Hexlet\Code\Formatters\getFormatter;
use function Funct\Collection\sortBy;

/**
 * @throws \Exception
 */
function genDiff($firstFile, $secondFile, $formatName = 'json')
{
    $dataFirstFile = getDataFromFile($firstFile);
    $dataSecondFile = getDataFromFile($secondFile);

    $tree = buildAstTree($dataFirstFile, $dataSecondFile);

    var_dump($tree[0]);
    exit();

    $ast = diffTwo($arr1, $arr2);
    $result = getJsonStyles($ast);

    return "{$result}\n";
}


/**
 * @param string $filePath
 * @return \stdClass
 * @throws \Exception
 */
function getDataFromFile(string $filePath): \stdClass
{
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $data = file_get_contents($filePath);

    return parseDate($data, $extension);
}

function buildAstTree($dataBefore, $dataAfter)
{
    $keys = array_unique([
        ...array_keys(get_object_vars($dataBefore)),
        ...array_keys(get_object_vars($dataAfter)),
    ]);

    $sortedKeys = sortBy($keys, fn($key) => $key);

    return array_map(function ($key) use ($dataBefore, $dataAfter) {
        if (!property_exists($dataBefore, $key)) {
            return makeNode($key, 'added', $dataAfter->$key);
        }

        if (!property_exists($dataAfter, $key)) {
            return makeNode($key, 'removed', $dataBefore->$key);
        }

        if (is_object($dataBefore->$key) && is_object($dataAfter->$key)) {
            return makeNode($key, 'nested', null, null, buildAstTree($dataBefore->$key, $dataAfter->$key));
        }

        if ($dataBefore->$key === $dataAfter->$key) {
            return makeNode($key, 'unchanged', $dataBefore->$key);
        }

        return makeNode($key, 'changed', $dataAfter->$key, $dataBefore->$key);
    }, $sortedKeys);
}

function makeNode($name, $state, $newValue = null, $oldValue = null, $children = null)
{
    $complexStates = [
        'changed' => fn($name, $state, $newValue, $oldValue, $children) => [
            'name' => $name,
            'oldValue' => $oldValue,
            'newValue' => $newValue,
            'state' => $state
        ],
        'nested' => fn($name, $state, $newValue, $oldValue, $children) => [
            'name' => $name,
            'state' => $state,
            'children' => $children
        ]
    ];

    if (array_key_exists($state, $complexStates)) {
        return $complexStates[$state]($name, $state, $newValue, $oldValue, $children);
    }

    return [
        'name' => $name,
        'value' => $newValue,
        'state' => $state
    ];
}

























//function getJsonStyles($data, $rep = 2): string
//{
//    $lines = array_map(function ($item) use ($rep) {
//        $indent = str_repeat(' ', $rep);
//
//        $value = ' ';
//        $value .= is_array($item['value']) ? getJsonStyles($item['value'], $rep + 4) : toString($item['value']);
//        if ($value === ' ') {
//            $value = '';
//        }
//
//        return match ($item['status']) {
//            'unchanged' => "{$indent}  {$item['key']}:{$value}",
//            'deleted' => "{$indent}- {$item['key']}:{$value}",
//            'added' => "{$indent}+ {$item['key']}:{$value}",
//            default => throw new \Exception('Undefined status!'),
//        };
//    }, $data);
//
//    $stt = str_repeat(' ', $rep - 2);
//
//    return implode("\n", ['{', ...$lines, $stt.'}']);
//}
//
//function toString($value): string
//{
//    if (is_null($value)) {
//        return 'null';
//    }
//
//    return trim(var_export($value, true), "'");
//}
//
//function diffTwo($arr1, $arr2)
//{
//    $commonKeys = array_unique([
//        ...array_keys($arr1),
//        ...array_keys($arr2),
//    ]);
//
//    sort($commonKeys);
//
//    $result = [];
//    foreach ($commonKeys as $key) {
//        $status = 'unchanged';
//        $value = '';
//        if (!array_key_exists($key, $arr2)) {
//            $status = 'deleted';
//            if (is_array($arr1[$key])) {
//                // TODO Реальзовать рекурсию???
//                $value = buildAst($arr1[$key]);
//            } else {
//                $value = $arr1[$key];
//            }
//
//            $result[] = [
//                'key' => $key,
//                'status' => $status,
//                'value' => $value,
//            ];
//        } elseif (!array_key_exists($key, $arr1)) {
//            $status = 'added';
//            if (is_array($arr2[$key])) {
//                // TODO Реальзовать рекурсию???
//                $value = buildAst($arr2[$key]);
//            } else {
//                $value = $arr2[$key];
//            }
//
//            $result[] = [
//                'key' => $key,
//                'status' => $status,
//                'value' => $value,
//            ];
//        } else {
//            if (is_array($arr1[$key]) && is_array($arr2[$key])) {
//                $value = diffTwo($arr1[$key], $arr2[$key]);
//
//                $result[] = [
//                    'key' => $key,
//                    'status' => $status,
//                    'value' => $value,
//                ];
//            } elseif ($arr1[$key] === $arr2[$key]) {
//                $value = $arr1[$key];
//
//                $result[] = [
//                    'key' => $key,
//                    'status' => $status,
//                    'value' => $value,
//                ];
//            } else {
//                if (is_array($arr1[$key])) {
//                    // TODO Реальзовать рекурсию???
//                    $value1 = buildAst($arr1[$key]);
//                } else {
//                    $value1 = $arr1[$key];
//                }
//
//                $result[] = [
//                    'key' => $key,
//                    'status' => 'deleted',
//                    'value' => $value1,
//                ];
//
//                if (is_array($arr2[$key])) {
//                    // TODO Реальзовать рекурсию???
//                    $value2 = buildAst($arr2[$key]);
//                } else {
//                    $value2 = $arr2[$key];
//                }
//
//                $result[] = [
//                    'key' => $key,
//                    'status' => 'added',
//                    'value' => $value2,
//                ];
//            }
//        }
//    }
//
//    return $result;
//}

//function buildAst(array $data): array
//{
//    $keys = array_keys($data);
//    $result = [];
//    foreach ($keys as $key) {
//        $result[] = [
//            'key' => $key,
//            'status' => 'unchanged',
//            'value' => is_array($data[$key]) ? buildAst($data[$key]) : $data[$key],
//        ];
//    }
//
//    return $result;
//}
