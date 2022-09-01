<?php

namespace Differ\Cli;

use Docopt;

use function Differ\Differ\genDiff;

/**
 * @throws \Exception
 */
function run(): string
{
    $doc = <<<DOC

    Generate diff
    
    Usage:
      gendiff (-h|--help)
      gendiff (-v|--version)
      gendiff [--format <fmt>] <firstFile> <secondFile>
    
    Options:
      -h --help                     Show this screen
      -v --version                  Show version
      --format <fmt>                Report format [default: stylish]
    
    DOC;

    $args = Docopt::handle($doc, array('version' => '1.0.0'));
    return genDiff($args['<firstFile>'], $args['<secondFile>'], $args['--format']);
}
