<?php
namespace Andileong\AliyunSms;


use Andileong\AliyunSms\Collection\PrepareSendSmsData;

class SendSms extends AliyunSmsApiRequest
{

    protected string $signature;
    protected string $templateCode;
    protected array $templateData;
    private $errorMsg;
    private $isSuccess;


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
        parent::__construct();
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

    protected function fire(?array $data = null)
    {
        $response = $response = $this->fireGetRequest($data);

        $responseBody = json_decode( $response->getBody()->getContents() , true );
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