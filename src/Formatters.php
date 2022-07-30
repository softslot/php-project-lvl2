<?php

namespace Hexlet\Code\Formatters;

use function Hexlet\Code\Formatters\JsonFormatter\renderJson;
use function Hexlet\Code\Formatters\PlainFormatter\renderPlain;
use function Hexlet\Code\Formatters\StylishFormatter\renderStylish;

function getFormatter($format)
{
    return match ($format) {
        'json'    => fn ($data) => renderJson($data),
        'plain'   => fn ($data) => renderPlain($data),
        'stylish' => fn ($data) => renderStylish($data),
        default   => throw new \Exception("Undefended format '{$format}'!"),
    };
}
