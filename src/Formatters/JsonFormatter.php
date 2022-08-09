<?php

namespace Differ\Formatters\JsonFormatter;

function renderJson($data)
{
    return json_encode($data, JSON_PRETTY_PRINT) . "\n";
}
