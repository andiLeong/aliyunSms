<?php
namespace tests\Mock;

class SignatureMock
{
    public function __construct(
        private Array $data,
        private String $secretKey
    )
    {
        //
    }

    public function make()
    {
        return "a test fake signature";
    }
}