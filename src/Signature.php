<?php
namespace Andileong\AliyunSms;

class Signature {

    public function __construct(
        private Array $data,
        private String $secretKey
    )
    {
        //
    }

    public function make()
    {

        return base64_encode(hash_hmac(
            'sha1',
            $this->getSignData(),
            $this->secretKey.'&',
            true
        ));
    }

    protected function filter(String $string)
    {
        $string = urlencode($string);
        $string = preg_replace( '/\+/', '%20', $string);
        $string = preg_replace( '/\*/', '%2A', $string);
        $string = preg_replace( '/%7E/', '~', $string);
        return $string;
    }

    protected function getSignData()
    {
        ksort($this->data );
        $data = '';
        foreach ( $this->data as $key => $value) {
            $data .= '&' . $this->filter($key) . '=' . $this->filter($value);
        }
        return 'GET&%2F&' . $this->filter( substr($data, 1) );
    }

}

