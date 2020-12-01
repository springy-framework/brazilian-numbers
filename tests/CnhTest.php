<?php

use PHPUnit\Framework\TestCase;

class CnhTest extends TestCase
{
    public function testInvalidCnh()
    {
        $brNum = new Springy\BrazilianNumbers();

        $this->assertFalse($brNum->isCnhValid(''));
        $this->assertFalse($brNum->isCnhValid('000'));
        $this->assertFalse($brNum->isCnhValid('11111111111'));
        $this->assertFalse($brNum->isCnhValid('2i059294129'));
        $this->assertFalse($brNum->isCnhValid('21059294120'));
    }

    public function testValidCnh()
    {
        $brNum = new Springy\BrazilianNumbers();

        $this->assertTrue($brNum->isCnhValid('21059294129'));
    }
}
