<?php

use PHPUnit\Framework\TestCase;

class NisTest extends TestCase
{
    public function testInvalidNis()
    {
        $brNum = new BrazilianNumbers();

        $this->assertFalse($brNum->isNisValid(''));
        $this->assertFalse($brNum->isNisValid('000'));
        $this->assertFalse($brNum->isNisValid('11111111111'));
        $this->assertFalse($brNum->isNisValid('640.58791.384'));
        $this->assertFalse($brNum->isNisValid('64058791385'));
        $this->assertFalse($brNum->isNisValid('64o58791384'));
    }

    public function testValidNis()
    {
        $brNum = new BrazilianNumbers();

        $this->assertTrue($brNum->isNisValid('64058791384'));
        $this->assertTrue($brNum->isNisValid('640.58791.38-4'));
    }
}