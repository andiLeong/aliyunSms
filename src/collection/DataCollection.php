<?php
namespace Andileong\AliyunSms\Collection;

use Andileong\AliyunSms\Signature;

abstract class DataCollection
{
    const VERSION = '2017-05-25';
    const SIGNATUREVERSION = '1.0';
    const SIGNATUREMETHOD = 'HMAC-SHA1';


    /**
     * SmsDataCollection constructor.
     * @param string $accessKeyId
     * @param string $accessKeySecret
     */
    public function __construct(
        private string $accessKeyId,
        private string $accessKeySecret,
    )
    {
        //
    }

    public function getPublicData()
    {
        return [
            'AccessKeyId' => $this->accessKeyId,
            'Action' =>  $this->getAction(),
            'Version' => self::VERSION,
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
            'SignatureVersion' => self::SIGNATUREVERSION,
            'SignatureNonce' => uniqid(),
            'SignatureMethod' => self::SIGNATUREMETHOD,
            'Format' => 'json',
        ];
    }


    abstract protected function getAction();
    abstract protected function prepare() :array ;


    public function get(): array
    {
        $data = array_merge($this->getPublicData(), $this->prepare());

        return array_merge( $data,
            ['Signature' => $this->getSignature($data , $this->accessKeySecret) ]
        );
    }

    /**
     * generate a signature based on the data
     * @param $data
     * @param $secretKey
     * @return string
     */
    public function getSignature($data,$secretKey): string
    {
        return (new Signature($data,$secretKey))->make();
    }

}