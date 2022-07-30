<?php

namespace Hexlet\Code\Parsers\JsonParser;

function parseJson(string $data): object
{
    return json_decode($data, false);
}
