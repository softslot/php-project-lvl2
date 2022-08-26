<?php

namespace Differ\Formatters;

use function Differ\Formatters\JsonFormatter\format as formatJson;
use function Differ\Formatters\PlainFormatter\format as formatPlain;
use function Differ\Formatters\StylishFormatter\format as formatStylish;

/**
 * @throws \Exception
 */
function format(array $data, string $format): string
{
    return match ($format) {
        'json'    => formatJson($data),
        'plain'   => formatPlain($data),
        'stylish' => formatStylish($data),
        default   => throw new \Exception("Undefended format: '{$format}'"),
    };
}
