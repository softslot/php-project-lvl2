<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private const PATH_TO_FIXTURES = __DIR__ . '/fixtures';
    private string $filePathJson1;
    private string $filePathJson2;
    private string $filePathYaml1;
    private string $filePathYaml2;
    private string $expectedOutputStylish;
    private string $expectedOutputPlain;
    private string $expectedOutputJson;

    protected function setUp(): void
    {
        $this->filePathJson1 = self::PATH_TO_FIXTURES . '/' . 'first_file.json';
        $this->filePathJson2 = self::PATH_TO_FIXTURES . '/' . 'second_file.json';
        $this->filePathYaml1 = self::PATH_TO_FIXTURES . '/' . 'first_file.yml';
        $this->filePathYaml2 = self::PATH_TO_FIXTURES . '/' . 'second_file.yml';

        $this->expectedOutputStylish = file_get_contents(
            self::PATH_TO_FIXTURES . '/' . 'expected_output_stylish.txt'
        );
        $this->expectedOutputPlain = file_get_contents(
            self::PATH_TO_FIXTURES . '/' . 'expected_output_plain.txt'
        );
        $this->expectedOutputJson = file_get_contents(
            self::PATH_TO_FIXTURES . '/' . 'expected_output_json.txt'
        );
    }

    public function testStylishWithJson(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2);
        $this->assertEquals($this->expectedOutputStylish, $result);
    }

    public function testStylishWithYaml(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2);
        $this->assertEquals($this->expectedOutputStylish, $result);
    }

    public function testPlainWithJson(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2, 'plain');
        $this->assertEquals($this->expectedOutputPlain, $result);
    }

    public function testPlainWithYaml(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2, 'plain');
        $this->assertEquals($this->expectedOutputPlain, $result);
    }

    public function testJsonWithJson(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2, 'json');
        $this->assertEquals($this->expectedOutputJson, $result);
    }

    public function testJsonWithYaml(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2, 'json');
        $this->assertEquals($this->expectedOutputJson, $result);
    }
}
