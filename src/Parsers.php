<?php

namespace Differ\Parsers;

use function Differ\Parsers\JsonParser\parseJson;
use function Differ\Parsers\YamlParser\parseYaml;

function parse(string $extension, string|false $data): object
{
    return match ($extension) {
        'json'        => parseJson($data),
        'yml', 'yaml' => parseYaml($data),
        default       => throw new \Exception("Undefended extension '{$extension}'!"),
    };
}
