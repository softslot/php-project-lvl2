<?php

namespace Differ\Parsers;

use function Differ\Parsers\JsonParser\parse as parseJson;
use function Differ\Parsers\YamlParser\parse as parseYaml;

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
