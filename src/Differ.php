<?php

namespace Differ\Differ;
use function Differ\Parser\getParse;

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

    $keys = array_unique(array_merge(array_keys($data1), array_keys($data2)));
    sort($keys);

    foreach ($keys as $key) {
        if (!array_key_exists($key, $data1)) {
            $result[] = "+ {$key}: " . stringify($data2[$key]);
        } elseif (!array_key_exists($key, $data2)) {
            $result[] = "- {$key}: " . stringify($data1[$key]);
        } elseif ($data1[$key] !== $data2[$key]) {
            $result[] = "- {$key}: " . stringify($data1[$key]);
            $result[] = "+ {$key}: " . stringify($data2[$key]);
        }elseif ($data1[$key] == $data2[$key]) {
            $result[] = "  {$key}: " . stringify($data2[$key]);
        }
    }
    return $result;
}

function stringify($value): string
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }
    if (is_array($value)) {
        return json_encode($value);
    }
    return (string)$value;
}

function getFileContent (string $path) 
{   
    if (!is_readable($path)) {
        throw new \Exception("File '{$path}' is not readable or does not exist.");
    }
    return file_get_contents($path);
}
function getExtension ($path1)
{
    return pathinfo($path1, $flags = PATHINFO_EXTENSION);
}