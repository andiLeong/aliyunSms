

## A package that send sms api request to aliyun 

A Package that communicate with aliyun sms api to trigger send sms functionality 
it's TDD using phpunit , using guzzle under the hood for http client.

## Installation
```
composer require andileong/aliyun-sms
```


## Usage

###send sms


```php

use Andileong\AliyunSms\SendSms;


$accessKeyId = 'your aliyun access key id';
$accessKeySecret = 'your aliyun access key secret';

$sms= new SendSms($accessKeyId,$accessKeySecret);

$signature = 'your aliyun signature';
$template_code = 'your aliyun template_code';
$data = ['code' => 444578 , 'product' => 'aaaaaa'];
$phoneNumber = '111111111111';
$res = $sms->setData($signature, $template_code ,$data)
->send($phoneNumber)
->isSuccess();
           
```

above call will return boolean , if return false you get the error message like so
```php
$sms->getErrorMsg();
// @see https://help.aliyun.com/document_detail/101414.html for more return data
```

### retrieve sms send history for a mobile number on a specific date


```php
use Andileong\AliyunSms\History;

$accessKeyId = 'your aliyun access key id';
$accessKeySecret = 'your aliyun access key secret';
$phoneNumber = '111111111111';

    $data = (new History($accessKeyId,$accessKeySecret))
        ->yesterday()
        ->onPage(1) //on which page 
        ->perPage(11) //on each page should contains page size max:50 
        ->fetch($phoneNumber);
    
    //you can get yesterday or today for specific phone number
    //using yesterday() or today()
    //if you want other than those 2 you can use setDate() like below
    
    $date = '20000101';
    $data = (new History($accessKeyId,$accessKeySecret))
        ->setDate($date)
        ->onPage(1) //on which page 
        ->perPage(11) //on each page should contains page size max:50 
        ->fetch($phoneNumber);
    
    //$date passed on above setDate() method must follow YYYYmmdd format
    
    //you can pass an optional biz argument for fetch method
    // it will check that one sms transaction
    // you can get that from bizid from sendsms api
    
    $data = (new History($accessKeyId,$accessKeySecret))
        ->yesterday()
        ->onPage(1) //on which page 
        ->perPage(11) //on each page should contains page size max:50 
        ->fetch($phoneNumber,'mybizid');
        
        // see https://help.aliyun.com/document_detail/102352.html for more return data
           
```
you will get all data return from aliyun if success if fails you will also get status code from aliyun



### check signature Validity 

```php
use Andileong\AliyunSms\CheckSignature;

$accessKeyId = 'your aliyun access key id';
$accessKeySecret = 'your aliyun access key secret';
$signature = '111111111111';

    $data = (new CheckSignature($this->accessKeyId,$this->accessKeySecret))
        ->check($signature);

    //it will check if you signature is valid or not 
    // see https://help.aliyun.com/document_detail/121210.html for more return data       
```