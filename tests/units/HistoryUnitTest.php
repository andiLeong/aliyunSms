<?php
namespace tests\units;


use Andileong\AliyunSms\History;
use InvalidArgumentException;
use tests\SmsTest;


class HistoryUnitTest extends SmsTest
{

    private History $history;

    public function setUp(): void
    {
        parent::setUp();
        $this->history = new History($this->accessKeyId,$this->accessKeySecret);
    }

    /** @test */
    public function it_can_set_per_page_property()
    {
        $this->history->perPage(33);
        $this->assertEquals(33,$this->history->getPerPage());
    }

    /** @test */
    public function it_throws_exception_if_per_page_property_larger_than_50()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->history->perPage(51);
    }

    /** @test */
    public function it_can_set_today_date()
    {
        $this->history->today();
        $this->assertEquals(date("Ymd"), $this->history->getDate());
    }

    /** @test */
    public function it_can_set_yesterday_date()
    {
        $this->history->yesterday();
        $this->assertEquals( date('Ymd',strtotime("-1 days")) , $this->history->getDate());
    }

    /** @test */
    public function it_can_set_date_property()
    {
        $date = '20211104';
        $this->history->setDate($date);
        $this->assertEquals( $date, $this->history->getDate());
    }

    /** @test */
    public function it_throws_exception_if_date_format_is_not_correct_format()
    {
        $this->expectException(InvalidArgumentException::class);
        $date = '2021-11-04';
        $this->history->setDate($date);
    }

    /** @test */
    public function it_can_set_on_page_property()
    {
        $this->history->onPage(2);
        $this->assertEquals(2,$this->history->getOnPage());
    }
}