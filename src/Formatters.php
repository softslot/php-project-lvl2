<?php

namespace Differ\Formatters;

use function Differ\Formatters\PlainFormatter\render as renderPlain;
use function Differ\Formatters\StylishFormatter\render as renderStylish;

/**
 * @throws \Exception
 */
function format(array $data, string $format): string
{
    return match ($format) {
        'json'    => json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT) . '',
        'plain'   => renderPlain($data),
        'stylish' => renderStylish($data),
        default   => throw new \Exception("Undefended format: '{$format}'"),
    };
}
