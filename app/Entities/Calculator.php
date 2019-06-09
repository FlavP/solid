<?php


namespace App\Entities;


class Calculator
{
    private $priceParser;

    public function __construct()
    {
        $this->priceParser = new PriceParser();
    }

    public function calculate(array $items) : float {
        $total = 0;
        foreach ($items as $item){
            $total += $this->priceParser->parse($item, 2) * $this->priceParser->parse($item, 1);
        }
        return $total;
    }
}