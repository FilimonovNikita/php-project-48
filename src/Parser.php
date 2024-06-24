<?php

namespace Diff\Src\Parser;

function getParser (string $content, string $extention){
    if ($extention == "json"){
        return json_decode($content);
    }
}