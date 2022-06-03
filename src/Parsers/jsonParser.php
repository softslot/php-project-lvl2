<?php

namespace Hexlet\Code\Parsers\JsonParser;

function parse($filePath)
{
    return json_decode(file_get_contents($filePath), true);
}
