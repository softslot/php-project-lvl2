<?php

namespace Differ\Parsers\JsonParser;

function parseJson(string $data): object
{
    return json_decode($data, false);
}
