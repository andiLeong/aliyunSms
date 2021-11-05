<?php
namespace Andileong\AliyunSms\Collection;


class PrepareHistoryData extends DataCollection
{

    public function __construct(
        private string $accessKeyId,
        private string $accessKeySecret,
        private string $date,
        private string $perPage ,
        private string $onPage ,
        private string $mobileNumber ,
        private $BizId = null,
    )
    {
        parent::__construct($accessKeyId,$accessKeySecret);
    }

    protected function getAction()
    {
        return "QuerySendDetails";
    }

    protected function prepare(): array
    {
        $data = [
            'PhoneNumber' => $this->mobileNumber,
            'SendDate' => $this->date,
            'PageSize' => $this->perPage,
            'CurrentPage' => $this->onPage,
        ];

        if(!is_null($this->BizId)){
            $data['BizId'] = $this->BizId;
        }

        return $data;
    }
}