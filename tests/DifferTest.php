<?php

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePathJson1 = __DIR__ . '/fixtures/file1.json';
    private string $filePathJson2 = __DIR__ . '/fixtures/file2.json';
    private string $filePathYaml1 = __DIR__ . '/fixtures/file1.yml';
    private string $filePathYaml2 = __DIR__ . '/fixtures/file2.yml';
    private string $expectedOutputStylish;
    private string $expectedOutputPlain;

    protected function setUp(): void
    {
        $this->expectedOutputStylish = file_get_contents(__DIR__ . '/fixtures/expected_output_stylish.txt');
        $this->expectedOutputPlain = file_get_contents(__DIR__ . '/fixtures/expected_output_plain.txt');
    }

    public function testDiffJsonStylish(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2);
        $this->assertEquals($this->expectedOutputStylish, $result);
    }

    public function testDiffYamlStylish(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2);
        $this->assertEquals($this->expectedOutputStylish, $result);
    }

    public function testDiffJsonPlain(): void
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2, 'plain');
        $this->assertEquals($this->expectedOutputPlain, $result);
    }

    public function testDiffYamlPlain(): void
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2, 'plain');
        $this->assertEquals($this->expectedOutputPlain, $result);
    }
}
