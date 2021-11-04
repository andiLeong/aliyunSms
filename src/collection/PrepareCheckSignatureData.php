<?php


namespace Andileong\AliyunSms\Collection;


use JetBrains\PhpStorm\Pure;

class PrepareCheckSignatureData extends DataCollection
{

    /**
     * PrepareCheckSignatureData constructor.
     * @param $accessKeyId
     * @param $accessKeySecret
     * @param $signature
     */
    public function __construct(
        private string $accessKeyId,
        private string $accessKeySecret,
        private string $signature,

    )
    {
        parent::__construct($accessKeyId,$accessKeySecret);
    }

    protected function getAction()
    {
        return 'QuerySmsSign';
    }

    protected function prepare(): array
    {
        return [
            'SignName' => $this->signature,
            'Action' => $this->getAction(),
        ];
    }
}