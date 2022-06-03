<?php

namespace Hexlet\Code\Parsers\YamlParser;

use Symfony\Component\Yaml\Yaml;

function parse($filePath)
{
    return Yaml::parseFile($filePath);
}
