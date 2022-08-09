<?php

namespace Differ\Formatters\JsonFormatter;

/**
 * @param array $data
 * @return string
 */
function renderJson(array $data): string
{
    return json_encode($data, JSON_PRETTY_PRINT);
}
