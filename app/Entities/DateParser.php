<?php


namespace App\Entities;


use App\Services\LineParserInterface;

class DateParser implements LineParserInterface
{
    public function parse($line, $position = 0) : \DateTime
    {
        preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/',$line, $matches);
        return new \DateTime($matches[0]);
    }
}