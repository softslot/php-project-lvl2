<?php

namespace Hexlet\Code\Formatters;

use function Hexlet\Code\Formatters\JsonFormatter\renderJson;
use function Hexlet\Code\Formatters\PlainFormatter\renderPlain;
use function Hexlet\Code\Formatters\StylishFormatter\renderStylish;

function getFormatter($tree, $format)
{
    return match ($format) {
        'json'    => renderJson($tree),
        'plain'   => renderPlain($tree),
        'stylish' => renderStylish($tree),
        default   => throw new \Exception("Undefended format '{$format}'!"),
    };
}
