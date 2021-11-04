<?php
namespace tests\Mock;


use Andileong\AliyunSms\AliyunSmsApiRequest;
use Andileong\AliyunSms\Collection\PrepareHistoryData;
use DateTime;

class HistoryMock extends AliyunSmsApiRequest
{
    public $setResultTo = true;

    protected $perPage = 10;
    protected $onPage = 1;
    protected $date;
    protected const DATEFORMAT = 'Ymd';


    /**
     * History constructor.
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


    public function perPage(int $perPage)
    {
        if ($perPage > 50) {
            throw new \InvalidArgumentException('per page cant grater than 50');
        }
        $this->perPage = $perPage;
        return $this;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string|int $date)
    {
        $date = DateTime::createFromFormat(self::DATEFORMAT, $date);
        if (!$date) {
            throw new \InvalidArgumentException('date format isn\'t in ymd');
        }
        $this->date = $date->format(self::DATEFORMAT);
        return $this;
    }

    public function onPage(int $page)
    {
        $this->onPage = $page;
        return $this;
    }

    public function getOnPage()
    {
        return $this->onPage;
    }

    public function today()
    {
        $this->date = date(self::DATEFORMAT);
        return $this;
    }

    public function yesterday()
    {
        $this->date = date(self::DATEFORMAT, strtotime("-1 days"));
        return $this;
    }

    public function fetch($mobileNumber, $BizId = null)
    {

        $collection = new PrepareHistoryData(
            $this->accessKeyId,
            $this->accessKeySecret,
            $this->date,
            $this->perPage,
            $this->onPage,
            $mobileNumber,
            $BizId,
        );

        return $this->fire($collection->get());
    }


    protected function fire(?array $data = null)
    {
        $status = $this->setResultTo ? 'OK' : 'isv.INVALID_JSON_PARAM';
        return ['Code' => $status];
    }

}