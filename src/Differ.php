<?php

namespace Differ\Differ;

use function Differ\Formatters\format;
use function Differ\Parsers\parse;
use function Functional\sort;

/**
 * @throws \Exception
 */
function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $dataFirstFile = parse(getDataFromFile($firstFilePath), getFileExtension($firstFilePath));
    $dataSecondFile = parse(getDataFromFile($secondFilePath), getFileExtension($secondFilePath));
    $tree = buildAstTree($dataFirstFile, $dataSecondFile);

    return format($tree, $format);
}

/**
 * @throws \Exception
 */
function getDataFromFile(string $filePath): string
{
    $data = file_get_contents($filePath);
    if ($data === false) {
        throw new \Exception("File not found: {$filePath}");
    }

    return $data;
}

function getFileExtension(string $filePath): string
{
    return pathinfo($filePath, PATHINFO_EXTENSION);
}

function buildAstTree(object $dataBefore, object $dataAfter): array
{
    $keys = array_unique([
        ...array_keys(get_object_vars($dataBefore)),
        ...array_keys(get_object_vars($dataAfter)),
    ]);

    $sortedKeys = sort($keys, fn ($left, $right) => strcmp($left, $right));

    return array_map(static function ($key) use ($dataBefore, $dataAfter) {
        $oldValue = $dataBefore->$key ?? null;
        $newValue = $dataAfter->$key ?? null;
        if (!property_exists($dataBefore, $key)) {
            return makeNode($key, 'added', newValue: $newValue);
        }

        if (!property_exists($dataAfter, $key)) {
            return makeNode($key, 'removed', oldValue: $oldValue);
        }

        if (is_object($oldValue) && is_object($newValue)) {
            return makeNode($key, 'nested', children: buildAstTree($oldValue, $newValue));
        }

        if ($oldValue === $newValue) {
            return makeNode($key, 'unchanged', $oldValue);
        }

        return makeNode($key, 'changed', $oldValue, $newValue);
    }, $sortedKeys);
}

function makeNode(
    string $name,
    string $type,
    mixed $oldValue = null,
    mixed $newValue = null,
    array $children = []
): array {
    return [
        'name'     => $name,
        'type'     => $type,
        'oldValue' => $oldValue,
        'newValue' => $newValue,
        'children' => $children,
    ];
}
