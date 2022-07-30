<?php

namespace Hexlet\Code\Parsers;

use function Hexlet\Code\Parsers\JsonParser\parseJson;
use function Hexlet\Code\Parsers\YamlParser\parseYaml;

function getParser(string $extension): callable
{
    return match ($extension) {
        'json'        => fn($data) => parseJson($data),
        'yml', 'yaml' => fn($data) => parseYaml($data),
        default       => throw new \Exception("Undefended format '{$extension}'!"),
    };
}
