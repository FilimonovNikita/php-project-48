<?php

namespace Diff\Tests\DifferenceTest;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

use function Diff\src\Differ\genDiff;

class DifferenceTest extends TestCase
{
    private function getFixturePath (string $path)
    {
        return __DIR__ . "/fixtures/" . $path;
    }

    public function  addDataProvider() : array
    {
        return array(
            ['file1.json', 'file2.json', 'json', 'formatJson.txt'],
            );
    }
    #[DataProvider('addDataProvider')];
    public function testGenDiff ($pathFile1, $pathfile2, $extention, $excepted)
    {
        $path1 = $this->getFixturePath($pathFile1);
        $path2 = $this->getFixturePath($pathfile2);
        $pathToExpected = $this->getFixturePath($excepted);

        $actual = genDiff($pathToFile1, $pathToFile2, $format);
        $this->assertStringEqualsFile($pathToExpected, $actual);
    }
}
    