<?php
namespace tests;

use PHPUnit\Framework\TestCase;

abstract class SmsTest extends testcase
{

    protected string $accessKeyId;
    protected string $accessKeySecret;
    protected string $phoneNumber;
    protected string $signature;

    public function setUp(): void
    {
        parent::setUp();

        $this->accessKeyId = 'accessKeyId';
        $this->accessKeySecret = 'accessKeySecret';
        $this->phoneNumber = '13722221111';
        $this->signature = '你的签名';

    }

}