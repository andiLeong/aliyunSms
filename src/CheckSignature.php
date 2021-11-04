<?php


namespace Andileong\AliyunSms;


use Andileong\AliyunSms\Collection\PrepareCheckSignatureData;

class CheckSignature extends AliyunSmsApiRequest
{

    /**
     * CheckSignature constructor.
     * @param string $accessKeyId
     * @param string $accessKeySecret
     */
    public function __construct(
        private string $accessKeyId,
        private string $accessKeySecret
    )
    {
        parent::__construct();
    }


    public function check($signature)
    {
        $collection = new PrepareCheckSignatureData(
            $this->accessKeyId,
            $this->accessKeySecret,
            $signature
        );

        return $this->fire($collection->get());
    }

    protected function fire(?array $data = null)
    {
        $response = $this->fireGetRequest($data);
        return json_decode( $response->getBody()->getContents() , true );
    }
}