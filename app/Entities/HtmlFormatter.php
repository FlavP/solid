<?php


namespace App\Entities;


use App\Services\FormatterInterface;

class HtmlFormatter implements FormatterInterface
{
    public function format(array $items, float $total)
    {
        $html = "<ul>";
        foreach ($items as $item){
            $html .= "<li>" . $item . "</li>";
        }
        $html .= "</ul>";
        $html .= "<h2>Total: " . $total . "</h2>";
        echo $html;
    }
}