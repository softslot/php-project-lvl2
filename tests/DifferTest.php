<?php

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePathJson1 = __DIR__ . '/fixtures/file1.json';
    private string $filePathJson2 = __DIR__ . '/fixtures/file2.json';
//    private string $filePathYaml1 = __DIR__ . '/fixtures/file1.yml';
//    private string $filePathYaml2 = __DIR__ . '/fixtures/file2.yml';
    private string $expected;

    protected function setUp(): void
    {
        $this->expected = file_get_contents(__DIR__ . '/fixtures/expected.txt');
    }

    public function testDiffJson()
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2);
        $this->assertEquals($this->expected, $result);
    }

//    public function testDiffYaml()
//    {
//        $result = genDiff($this->filePathYaml1, $this->filePathYaml2);
//        $this->assertEquals($this->expected, $result);
//    }
}
