<?php
namespace Andileong\AliyunSms;


abstract class AliyunSmsApiRequest
{


    public $httpClient;

    /**
     * AliyunSmsApiRequest constructor.
     */
    public function __construct(

    )
    {
        $this->httpClient = new \GuzzleHttp\Client();
    }

    public function fireGetRequest($data = [])
    {
        return $this->httpClient->request('GET', $this->getEndpoint(), [
            'query' => $data
        ]);
    }

    public function getEndpoint(): string
    {
        return 'https://dysmsapi.aliyuncs.com';
    }

    abstract protected function fire(?array $data = null);

}