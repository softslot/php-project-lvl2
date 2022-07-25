<?php

namespace Hexlet\Code\Parsers\YamlParser;

use Symfony\Component\Yaml\Yaml;

function parse(string $data): object
{
    return Yaml::parse($data, Yaml::PARSE_OBJECT_FOR_MAP);
}