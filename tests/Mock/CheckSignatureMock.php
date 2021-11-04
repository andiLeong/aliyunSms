<?php
namespace tests\Mock;

class CheckSignatureMock
{
    public function check($signature)
    {
        return ['Code' => 'OK'];
    }
}