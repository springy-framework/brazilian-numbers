<?php

use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    public function testInvalidCpf()
    {
        $brNum = new BrazilianNumbers();

        $this->assertFalse($brNum->isCpfValid(''));
        $this->assertFalse($brNum->isCpfValid('000'));
        $this->assertFalse($brNum->isCpfValid('00000000000'));
        $this->assertFalse($brNum->isCpfValid('000000000-00'));
        $this->assertFalse($brNum->isCpfValid('000.000000-00'));
        $this->assertFalse($brNum->isCpfValid('000000.000-00'));
        $this->assertFalse($brNum->isCpfValid('000.000.00000'));
        $this->assertFalse($brNum->isCpfValid('000.000.000-00'));
        $this->assertFalse($brNum->isCpfValid('12345678901'));
        $this->assertFalse($brNum->isCpfValid('89967873613'));
        $this->assertFalse($brNum->isCpfValid('8996787361A'));
    }

    public function testValidCpf()
    {
        $brNum = new BrazilianNumbers();

        $this->assertTrue($brNum->isCpfValid('89967873612'));
        $this->assertTrue($brNum->isCpfValid('899.678.736-12'));
    }
}