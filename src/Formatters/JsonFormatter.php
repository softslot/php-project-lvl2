<?php

namespace Differ\Formatters\JsonFormatter;

/**
 * @throws \JsonException
 */
function renderJson(array $data): string
{
    return json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
}
