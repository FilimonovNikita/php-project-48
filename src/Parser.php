<?php

namespace Differ\Parser;

function getParse (string $content, string $extention){
    if ($extention == "json"){
        return json_decode($content, true);
    }
}