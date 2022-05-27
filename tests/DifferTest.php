<?php

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePathJson1 = 'tests/fixtures/file1.json';
    private string $filePathJson2 = 'tests/fixtures/file2.json';
    private string $filePathYaml1 = 'tests/fixtures/file1.yml';
    private string $filePathYaml2 = 'tests/fixtures/file2.yml';

    private string $expected = "{
  - follow : false
    host : hexlet.io
  - proxy : 123.234.53.22
  - timeout : 50
  + timeout : 20
  + verbose : true
}
";

    public function testDiffJson()
    {
        $result = genDiff($this->filePathJson1, $this->filePathJson2);
        $this->assertEquals($this->expected, $result);
    }

    public function testDiffYaml()
    {
        $result = genDiff($this->filePathYaml1, $this->filePathYaml2);
        $this->assertEquals($this->expected, $result);
    }
}
