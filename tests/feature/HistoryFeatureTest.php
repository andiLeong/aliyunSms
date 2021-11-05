<?php
namespace tests\feature;

use Andileong\AliyunSms\History;
use tests\Mock\HistoryMock;
use tests\SmsTest;

class HistoryFeatureTest extends SmsTest
{

    private History $history;
    private HistoryMock $historyMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->history = new History($this->accessKeyId,$this->accessKeySecret);
        $this->historyMock = new HistoryMock($this->accessKeyId,$this->accessKeySecret);
    }

    /** @test */
    public function it_can_fetch_sms_history()
    {
        $data = $this->historyMock
            ->yesterday()
            ->onPage(1)
            ->perPage(11)
            ->fetch($this->phoneNumber);

        $this->assertIsArray($data);
    }


}