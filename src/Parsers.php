<?php

namespace Differ\Parsers;

use function Differ\Parsers\JsonParser\parseJson;
use function Differ\Parsers\YamlParser\parseYaml;

function getParser(string $extension): callable
{
    return match ($extension) {
        'json'        => fn($data) => parseJson($data),
        'yml', 'yaml' => fn($data) => parseYaml($data),
        default       => throw new \Exception("Undefended extension '{$extension}'!"),
    };
}
