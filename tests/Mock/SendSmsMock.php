<?php
namespace tests\Mock;



use Andileong\AliyunSms\Collection\PrepareSendSmsData;

class SendSmsMock
{
    const ENDPOINT = 'https://dysmsapi.aliyuncs.com';

    protected string $signature;
    protected string $templateCode;
    protected array $templateData;
    private $errorMsg;
    private $isSuccess;
    public $setResultTo = true;


    /**
     * Sms constructor.
     * @param string $accessKeyId
     * @param string $accessKeySecret
     */
    public function __construct(
        private string $accessKeyId,
        private string $accessKeySecret
    )
    {
        //
    }

    public function setData(string $signature , string $templateCode , array $templateData = [])
    {
        $this->signature = $signature;
        $this->templateCode = $templateCode;
        $this->templateData = $templateData;
        return $this;
    }


    public function send(string|int $mobileNumber )
    {
        $collection = new PrepareSendSmsData(
            $this->accessKeyId,
            $this->accessKeySecret,
            $this->signature,
            $this->templateCode,
            $mobileNumber,
            $this->templateData
        );

        $this->fire($collection->get());
        return $this;
    }

    private function fire(array $data)
    {

        $status = $this->setResultTo ? 'OK' : 'isv.INVALID_JSON_PARAM';
        $responseBody = ['Code' => $status];
        if( isset($responseBody['Code']) && !empty($responseBody['Code']) && $responseBody['Code'] == 'OK'){
            $this->setIsSuccess(true);
            return ;
        }

        $this->setErrorMsg($responseBody);
        $this->setIsSuccess(false);

    }

    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    public function setErrorMsg($message)
    {
        return $this->errorMsg = $message;
    }

    public function setIsSuccess($res)
    {
        return $this->isSuccess = $res;
    }

    public function isSuccess()
    {
        return $this->isSuccess;
    }

}