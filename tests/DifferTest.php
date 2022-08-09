<?php

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePathJson1 = __DIR__ . '/fixtures/first_file.json';
    private string $filePathJson2 = __DIR__ . '/fixtures/second_file.json';
    private string $filePathYaml1 = __DIR__ . '/fixtures/first_file.yml';
    private string $filePathYaml2 = __DIR__ . '/fixtures/second_file.yml';
    private string $expectedOutputStylish;
    private string $expectedOutputPlain;
    private string $expectedOutputJson;

    protected function setUp(): void
    {
        $this->expectedOutputStylish = file_get_contents(__DIR__ . '/fixtures/expected_output_stylish.txt');
        $this->expectedOutputPlain = file_get_contents(__DIR__ . '/fixtures/expected_output_plain.txt');
        $this->expectedOutputJson = file_get_contents(__DIR__ . '/fixtures/expected_output_json.txt');
    }

    public function testDiffJsonStylish(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2);
        $this->assertEquals($this->expectedOutputStylish, $result);
    }

    public function testDiffYamlOutputStylish(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2);
        $this->assertEquals($this->expectedOutputStylish, $result);
    }

    public function testDiffJsonOutputPlain(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2, 'plain');
        $this->assertEquals($this->expectedOutputPlain, $result);
    }

    public function testDiffYamlOutputPlain(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2, 'plain');
        $this->assertEquals($this->expectedOutputPlain, $result);
    }

    public function testDiffJsonOutputJson(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2, 'json');
        $this->assertEquals($this->expectedOutputJson, $result);
    }

    public function testDiffYamlOutputJson(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2, 'json');
        $this->assertEquals($this->expectedOutputJson, $result);
    }
}
