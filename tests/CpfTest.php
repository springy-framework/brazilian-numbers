<?php

/**
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Springy\Utils\BrazilianNumbers\Cpf;

final class CpfTest extends TestCase
{
    public function testMaskUnmask()
    {
        $this->assertEquals(Cpf::unmask('899.678.736-12'), '89967873612');
        $this->assertEquals(Cpf::mask('89967873612'), '899.678.736-12');
    }

    public function testInvalidCpf()
    {
        $this->assertFalse(Cpf::isValid(''));
        $this->assertFalse(Cpf::isValid('000'));
        $this->assertFalse(Cpf::isValid('00000000000'));
        $this->assertFalse(Cpf::isValid('899 67873612'));
        $this->assertFalse(Cpf::isValid('899.67873612'));
        $this->assertFalse(Cpf::isValid('899678736-12'));
        $this->assertFalse(Cpf::isValid('899.678.736.12'));
        $this->assertFalse(Cpf::isValid('899.678.736/12'));
        $this->assertFalse(Cpf::isValid('12345678901'));
        $this->assertFalse(Cpf::isValid('89967873613'));
        $this->assertFalse(Cpf::isValid('8996787361A'));
    }

    public function testValidCpf()
    {
        $this->assertTrue(Cpf::isValid('89967873612'));
        $this->assertTrue(Cpf::isValid('899.678.736-12'));
    }
}
