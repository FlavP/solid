<?php


namespace App\Entities;


use App\Services\ReaderInterface;

class FileReader implements ReaderInterface
{
    private $filename;
    private $parser;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->parser = new DateParser();
    }

    public function ordersBetween(\DateTime $start, \DateTime $end) : array
    {
        $results = [];
        $fileLines = file(__DIR__ . "/../../storage/" . $this->filename);
        foreach ($fileLines as $line){
            $result = $this->parser->parse($line);
            if ($result > $start && $result < $end)
                $results[] = $line;
        }
        return $results;
    }
}