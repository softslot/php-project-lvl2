<?php

namespace Differ\Formatters\JsonFormatter;

function renderJson(array $data): string
{
    return json_encode($data, JSON_PRETTY_PRINT);
}
