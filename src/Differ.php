<?php

namespace Diff\src\Differ;
use function Diff\Src\Parser\getParse;

function genDiff (string $pathToFile1, string $pathToFile2)
{
    $structer1 = getParse(getFileContent($pathToFile1), getExtension($pathToFile1)); // content of file in php format
    $structer2 = getParse(getFileContent($pathToFile2), getExtension($pathToFile2));
    $result = getDiftree($structer1, $structer2);
    return $result;
}
function getDiftree($data1, $data2)
{
    $result = [];

    foreach ($data1 as $key => $value) {
        if (!array_key_exists($key, $data2)) {
            $result[] = "- $key: $value";
        } elseif ($value !== $data2[$key]) {
            $result[] = "- $key: $value";
            $result[] = "+ $key: " . $data2[$key];
        }
    }

    foreach ($data2 as $key => $value) {
        if (!array_key_exists($key, $data1)) {
            $result[] = "+ $key: $value";
        }
    }
    return $result;
}

function getFileContent (string $path) 
{
    if (is_readable($path)) {
        return file_get_contents($path);
    }
}
function getExtension ($path1)
{
    return pathinfo($path1, PATHINFO_EXTENSION);
}