<?php


namespace App\Entities;


use App\Services\FormatterInterface;
use App\Services\ReaderInterface;

class SalesReporter
{
    private $reader;
    private $calculator;
    private $formatter;
    private $orders = [];
    private $total;

    public function __construct(
        ReaderInterface $reader,
        FormatterInterface $formatter
    )
    {
        $this->reader = $reader;
        $this->calculator = new Calculator();
        $this->formatter = $formatter;
    }

    public function getOrders(\DateTime $start, \DateTime $end) :array {
        $this->orders = $this->reader->ordersBetween($start, $end);
        return $this->orders;
    }

    public function getTotal() : float {
        $this->total = $this->calculator->calculate($this->orders);
        return $this->total;
    }

    public function display() {
        echo $this->formatter->format($this->orders, $this->total);
    }
}