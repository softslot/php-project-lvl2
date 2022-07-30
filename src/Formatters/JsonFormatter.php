<?php

namespace Hexlet\Code\Formatters\JsonFormatter;

function renderJson($data)
{
    return json_encode($data, JSON_PRETTY_PRINT);
}
