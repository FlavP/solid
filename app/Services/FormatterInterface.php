<?php


namespace App\Services;


interface FormatterInterface
{
    public function format(array $items, float $total);
}