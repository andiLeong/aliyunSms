<?php
namespace Andileong\AliyunSms\Collection;


class PrepareSendSmsData extends DataCollection
{

    /**
     * SmsDataCollection constructor.
     */
    public function __construct(
        private string $accessKeyId,
        private string $accessKeySecret,
        private string $signature,
        private string $templateCode ,
        private string $mobileNumber ,
        private array $templateData = [],
    )
    {
        parent::__construct($accessKeyId,$accessKeySecret);
    }


    protected function prepare(): array
    {
        $data = [
            'PhoneNumbers' => $this->mobileNumber,
            'SignName' => $this->signature,
            'TemplateCode' => $this->templateCode,
        ];

        if(sizeof($this->templateData) > 0){
            $data['TemplateParam'] = json_encode($this->templateData , JSON_UNESCAPED_UNICODE);
        }

        return $data;
    }

    protected function getAction()
    {
        return 'SendSms';
    }
}