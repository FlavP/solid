<?php


namespace App\Services;


interface ReaderInterface
{
    public function ordersBetween(\DateTime $start, \DateTime $end);
}