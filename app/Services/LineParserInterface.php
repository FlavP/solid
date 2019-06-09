<?php


namespace App\Services;


interface LineParserInterface
{
    public function parse($line, $position);
}