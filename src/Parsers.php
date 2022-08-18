<?php

namespace Differ\Parsers;

use function Differ\Parsers\JsonParser\parseJson;
use function Differ\Parsers\YamlParser\parseYaml;

/**
 * @throws \Exception
 */
function parse(string $data, string $extension): object
{
    return match ($extension) {
        'json'        => parseJson($data),
        'yml', 'yaml' => parseYaml($data),
        default       => throw new \Exception("Undefended extension: '{$extension}'"),
    };
}
