<?php

namespace Differ\Formatters;

use function Differ\Formatters\JsonFormatter\renderJson;
use function Differ\Formatters\PlainFormatter\renderPlain;
use function Differ\Formatters\StylishFormatter\renderStylish;

/**
 * @throws \Exception
 */
function format(array $data, string $format): string
{
    return match ($format) {
        'json'    => renderJson($data),
        'plain'   => renderPlain($data),
        'stylish' => renderStylish($data),
        default   => throw new \Exception("Undefended format: '{$format}'"),
    };
}
