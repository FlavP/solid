<?php


class SalesReporterTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    function a_price_parser_returns_a_the_price_from_the_second_to_last_position(){
        $parser = new \App\Entities\PriceParser();
        $result = $parser->parse("2019-05-29 11:22:35 t-shirt 5.99 1", 2);
        $this->assertEquals(5.99, $result);
    }

    /** @test */
    function a_price_parser_returns_the_quantity_from_the__last_position(){
        $parser = new \App\Entities\PriceParser();
        $result = $parser->parse("2019-05-29 11:22:35 t-shirt 5.99 1", 1);
        $this->assertEquals(1, $result);
    }

    /** @test */
    function a_date_parser_returns_a_date_object(){
        $parser = new \App\Entities\DateParser();
        $result = $parser->parse("2019-05-29 11:22:35 t-shirt 5.99 1");
        $this->assertInstanceOf(DateTime::class, $result);
    }

    /** @test */
    function a_sales_reporter_has_order_in_the_last_ten_days(){
        $start = new DateTime('2019-06-01T00:00:00');
        $end = new DateTime('2019-06-09T00:00:00');
        $reporter = new \App\Entities\SalesReporter(
            new \App\Entities\FileReader("orders.txt"),
            new \App\Entities\HtmlFormatter()
        );
        $this->assertGreaterThan(0, count($reporter->getOrders($start, $end)));
    }

    /** @test */
    function a_product_has_a_correct_price(){
        $lines = [];
        $lines[] = "2019-05-29 11:22:35 t-shirt 10 1";
        $lines[] = "2019-05-29 11:22:35 jeans 20 2";
        $calculator = new \App\Entities\Calculator();
        $this->assertEquals(50, $calculator->calculate($lines));
    }

    /** @test */
    function a_list_of_orders_is_displayed(){
        $start = new DateTime('2019-06-01T00:00:00');
        $end = new DateTime('2019-06-09T00:00:00');
        $reporter = new \App\Entities\SalesReporter(
            new \App\Entities\FileReader("orders.txt"),
            new \App\Entities\HtmlFormatter()
        );
        $orders = $reporter->getOrders($start, $end);
        $reporter->getTotal();

        $reporter->display();
    }
}