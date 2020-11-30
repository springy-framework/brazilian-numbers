<?php

use PHPUnit\Framework\TestCase;

class CnpjTest extends TestCase
{
    public function testInvalidCnpj()
    {
        $brNum = new BrazilianNumbers();

        $this->assertFalse($brNum->isCnpjValid(''));
        $this->assertFalse($brNum->isCnpjValid('000'));
        $this->assertFalse($brNum->isCnpjValid('00000000000000'));
        $this->assertFalse($brNum->isCnpjValid('76 871442000175'));
        $this->assertFalse($brNum->isCnpjValid('768714420001-75'));
        $this->assertFalse($brNum->isCnpjValid('768714420001/75'));
        $this->assertFalse($brNum->isCnpjValid('76871442000176'));
    }

    public function testValidCnpj()
    {
        $brNum = new BrazilianNumbers();

        $this->assertTrue($brNum->isCnpjValid('76871442000175'));
        $this->assertTrue($brNum->isCnpjValid('76.871.442/0001-75'));
    }
}
