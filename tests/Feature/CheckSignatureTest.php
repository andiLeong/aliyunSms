<?php
namespace tests\feature;


use Andileong\AliyunSms\CheckSignature;

use tests\Mock\CheckSignatureMock;
use tests\SmsTest;

class CheckSignatureTest extends SmsTest
{

    public CheckSignature $CheckSignature;
    public CheckSignatureMock $CheckSignatureMock;

    public function setUp(): void
    {
        parent::setUp();
        $this->CheckSignature = new CheckSignature($this->accessKeyId,$this->accessKeySecret);
        $this->CheckSignatureMock = new CheckSignatureMock();

    }

    /** @test */
    public function it_can_check_sms_signature_status()
    {
        $data = $this->CheckSignatureMock->check($this->signature);
        $this->assertIsArray($data);
    }
}