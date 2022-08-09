<?php

namespace Differ\Differ;

use function Differ\Formatters\getFormatter;
use function Differ\Parsers\getParser;
use function Funct\Collection\sortBy;

function genDiff(string $firstFilePath, string $secondFilePath, string $format = 'stylish'): string
{
    $dataFirstFile = getDataFromFile($firstFilePath);
    $dataSecondFile = getDataFromFile($secondFilePath);
    $tree = buildAstTree($dataFirstFile, $dataSecondFile);
    $formatter = getFormatter($format);

    return $formatter($tree);
}

function getDataFromFile(string $filePath): object
{
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $data = file_get_contents($filePath);
    $parser = getParser($extension);

    return $parser($data);
}

function buildAstTree($dataBefore, $dataAfter): array
{
    $keys = array_unique([
        ...array_keys(get_object_vars($dataBefore)),
        ...array_keys(get_object_vars($dataAfter)),
    ]);

    $sortedKeys = sortBy($keys, fn($key) => $key);

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

function makeNode($name, $status, $oldValue = null, $newValue = null, $children = []): array
{
    return [
        'name'     => $name,
        'status'   => $status,
        'oldValue' => $oldValue,
        'newValue' => $newValue,
        'children' => $children,
    ];
}
