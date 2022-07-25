<?php

namespace Hexlet\Code\Parsers\JsonParser;

function parse(string $data): object
{
    return json_decode($data);
}
