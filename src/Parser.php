<?php

namespace Differ\Parser;

use Symfony\Component\Yaml\Yaml;

function getParse(string $content, string $extension)
{
    switch ($extension) {
        case 'json':
            return json_decode($content, true);
        case 'yaml':
        case 'yml':
            return Yaml::parse($content);
        default:
            throw new \Exception("Unsupported file extension: {$extension}");
    }
}