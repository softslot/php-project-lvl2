<?php

namespace Hexlet\Code\Formatters\JsonFormatter;

function render($data)
{
    echo (string) json_encode($data, JSON_PRETTY_PRINT);
}
