<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private const PATH_TO_FIXTURES = __DIR__ . '/fixtures';

    /**
     * @dataProvider differProvider
     * @throws \Exception
     */
    public function testDiffer(string $fileName1, string $fileName2, string $format, string $expected): void
    {
        $result = genDiff($this->getFullPath($fileName1), $this->getFullPath($fileName2), $format);
        $expectedDiff = $this->getFullPath($expected);

        $this->assertStringEqualsFile($expectedDiff, $result);
    }

    public function differProvider(): array
    {
        return [
            ['first_file.json', 'second_file.json', 'stylish' , 'expected_output_stylish.txt'],
            ['first_file.yml', 'second_file.yml', 'stylish' , 'expected_output_stylish.txt'],
            ['first_file.json', 'second_file.json', 'plain', 'expected_output_plain.txt'],
            ['first_file.yml', 'second_file.yml', 'plain', 'expected_output_plain.txt'],
            ['first_file.json', 'second_file.json', 'json', 'expected_output_json.txt'],
            ['first_file.yml', 'second_file.yml', 'json', 'expected_output_json.txt'],
        ];
    }

    private function getFullPath(string $fileName): string
    {
        return self::PATH_TO_FIXTURES . '/' . $fileName;
    }
}
