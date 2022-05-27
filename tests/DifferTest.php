<?php

use PHPUnit\Framework\TestCase;

use function Hexlet\Code\Differ\genDiff;

class DifferTest extends TestCase
{
    private string $filePath1 = 'tests/fixtures/file1.json';
    private string $filePath2 = 'tests/fixtures/file2.json';

    public function testDiff()
    {
        $result = genDiff($this->filePath1, $this->filePath2);
        $expected = "{
  - follow : false
    host : hexlet.io
  - proxy : 123.234.53.22
  - timeout : 50
  + timeout : 20
  + verbose : true
}
";
        $this->assertEquals($expected, $result);
    }
}
