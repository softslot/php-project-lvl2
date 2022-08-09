<?php

namespace Differ\Formatters;

use function Differ\Formatters\JsonFormatter\renderJson;
use function Differ\Formatters\PlainFormatter\renderPlain;
use function Differ\Formatters\StylishFormatter\renderStylish;

function getFormatter(string $format): callable
{
    return match ($format) {
        'json'    => fn ($data) => renderJson($data),
        'plain'   => fn ($data) => renderPlain($data),
        'stylish' => fn ($data) => renderStylish($data),
        default   => throw new \Exception("Undefended format '{$format}'!"),
    };
}
