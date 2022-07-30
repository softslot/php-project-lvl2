<?php

namespace Hexlet\Code\Parsers;

use function Hexlet\Code\Parsers\JsonParser\parseJson;
use function Hexlet\Code\Parsers\YamlParser\parseYaml;

/**
 * @throws \Exception
 */
function parseDate($data, $extension)
{
    return match ($extension) {
        'json' => parseJson($data),
        'yml', 'yaml' => parseYaml($data),
        default => throw new \Exception("Undefended format '{$extension}'!"),
    };
}
