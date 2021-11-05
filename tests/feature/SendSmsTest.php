<?php
namespace tests\feature;


use Andileong\AliyunSms\SendSms;
use tests\Mock\SendSmsMock;
use tests\SmsTest;


class SendSmsTest extends SmsTest
{

    private SendSms $sendSms;
    private SendSmsMock $sendSmsMock;

    public function setUp() :void
    {
        parent::setUp();

        $this->sendSms = new SendSms($this->accessKeyId,$this->accessKeySecret);
        $this->sendSmsMock = new SendSmsMock($this->accessKeyId,$this->accessKeySecret);
    }

    /** @test */
    public function it_can_get_error_message_if_aliyun_return_unsuccessful_response()
    {
        $this->sendSmsMock->setResultTo = false;
        $res = $this->sendSmsMock->setData('aaaaaaaa' , 'SMS_')
            ->send($this->phoneNumber)
            ->isSuccess();

        $this->assertFalse( $res);
        $this->assertIsArray( $this->sendSmsMock->getErrorMsg());
        $this->assertNotEquals(  'OK' , $this->sendSmsMock->getErrorMsg()['Code']);
    }


    /** @test */
    public function it_can_send_a_sms_message()
    {
        $res =  $this->sendSmsMock
                ->setData($this->signature, 'SMS_' ,
                    ['code' => 444578 , 'product' => 'aaaaaa']
                )
                ->send($this->phoneNumber)
                ->isSuccess();
        $this->assertTrue($res);
    }


    /** @test */
    public function it_can_send_a_sms_message_without_any_template_data()
    {
        $templateCode = 'SMS_';
        $res = $this->sendSmsMock
            ->setData($this->signature  , $templateCode)
            ->send($this->phoneNumber)
            ->isSuccess();

        $this->assertTrue($res);
    }


}