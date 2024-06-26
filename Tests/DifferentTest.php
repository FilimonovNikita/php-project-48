<?php

namespace Diff\Tests\DifferentTest;

use PHPUnit\Framework\TestCase;
//use PHPUnit\Framework\Attributes\DataProvider;

use function Differ\Differ\genDiff;

class DifferentTest extends TestCase
{
    private function getFixturePath (string $path)
    {
        return __DIR__ . "/fixtures/" . $path;
    }

    public function testGenDiff()
    {
        $fixture1 = $this->getFixturePath('file1.json');
        $fixture2 = $this->getFixturePath('file2.json');
        $actual = genDiff($fixture1, $fixture2);
        $expected = file_get_contents($this->getFixturePath('expectedStylish.txt'));
        $this->assertEquals($expected, $actual);
        
    }
}
    