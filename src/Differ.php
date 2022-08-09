<?php

namespace Differ\Differ;

use function Differ\Formatters\getFormatter;
use function Differ\Parsers\getParser;
use function Functional\sort;

/**
 * @param string $firstFilePath
 * @param string $secondFilePath
 * @param string $format
 * @return string
 * @throws \Exception
 */
function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $dataFirstFile = getDataFromFile($firstFilePath);
    $dataSecondFile = getDataFromFile($secondFilePath);
    $tree = buildAstTree($dataFirstFile, $dataSecondFile);
    $formatter = getFormatter($format);

    return $formatter($tree);
}

/**
 * @param string $filePath
 * @return object
 * @throws \Exception
 */
function getDataFromFile(string $filePath): object
{
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $data = file_get_contents($filePath);
    $parser = getParser($extension);

    return $parser($data);
}

/**
 * @param object $dataBefore
 * @param object $dataAfter
 * @return array
 */
function buildAstTree(object $dataBefore, object $dataAfter): array
{
    $keys = array_unique([
        ...array_keys(get_object_vars($dataBefore)),
        ...array_keys(get_object_vars($dataAfter)),
    ]);

    $sortedKeys = sort($keys, fn ($left, $right) => strcmp($left, $right));

    return array_map(function ($key) use ($dataBefore, $dataAfter) {
        if (!property_exists($dataBefore, $key)) {
            return makeNode($key, 'added', newValue: $dataAfter->$key);
        }

        if (!property_exists($dataAfter, $key)) {
            return makeNode($key, 'removed', oldValue: $dataBefore->$key);
        }

        if (is_object($dataBefore->$key) && is_object($dataAfter->$key)) {
            return makeNode($key, 'nested', children: buildAstTree($dataBefore->$key, $dataAfter->$key));
        }

        if ($dataBefore->$key === $dataAfter->$key) {
            return makeNode($key, 'unchanged', $dataBefore->$key);
        }

        return makeNode($key, 'changed', $dataBefore->$key, $dataAfter->$key);
    }, $sortedKeys);
}

/**
 * @param string $name
 * @param string $status
 * @param mixed|null $oldValue
 * @param mixed|null $newValue
 * @param array $children
 * @return array
 */
function makeNode(
    string $name,
    string $status,
    mixed $oldValue = null,
    mixed $newValue = null,
    array $children = []
): array {
    return [
        'name'     => $name,
        'status'   => $status,
        'oldValue' => $oldValue,
        'newValue' => $newValue,
        'children' => $children,
    ];
}
