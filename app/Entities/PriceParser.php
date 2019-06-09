<?php


namespace App\Entities;


use App\Services\LineParserInterface;

class PriceParser implements LineParserInterface
{
    public function parse($line, $position = 0) : float
    {
        $words = explode(' ', $line);
        return $words[count($words) - $position];
    }
}