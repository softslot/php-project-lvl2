<?php

namespace Differ\Parsers\JsonParser;

/**
 * @throws \JsonException
 */
function parseJson(string $data): object
{
    return json_decode($data, false, 512, JSON_THROW_ON_ERROR);
}
