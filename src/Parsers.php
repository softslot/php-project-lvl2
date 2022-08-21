<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

/**
 * @throws \Exception
 */
function parse(string $data, string $extension): object
{
    return match ($extension) {
        'json'        => json_decode($data, false, 512, JSON_THROW_ON_ERROR),
        'yml', 'yaml' => Yaml::parse($data, Yaml::PARSE_OBJECT_FOR_MAP),
        default       => throw new \Exception("Undefended extension: '{$extension}'"),
    };
}
