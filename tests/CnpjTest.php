<?php

/**
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Springy\Utils\BrazilianNumbers\Cnpj;

final class CnpjTest extends TestCase
{
    public function testMaskUnmask()
    {
        $this->assertEquals(Cnpj::unmask('76.871.442/0001-75'), '76871442000175');
        $this->assertEquals(Cnpj::mask('76871442000175'), '76.871.442/0001-75');
    }

    public function testInvalidCnpj()
    {
        $this->assertFalse(Cnpj::isValid(''));
        $this->assertFalse(Cnpj::isValid('000'));
        $this->assertFalse(Cnpj::isValid('00000000000000'));
        $this->assertFalse(Cnpj::isValid('76 871442000175'));
        $this->assertFalse(Cnpj::isValid('768714420001-75'));
        $this->assertFalse(Cnpj::isValid('768714420001/75'));
        $this->assertFalse(Cnpj::isValid('76871442000176'));
    }

    public function testValidCnpj()
    {
        $this->assertTrue(Cnpj::isValid('76871442000175'));
        $this->assertTrue(Cnpj::isValid('76.871.442/0001-75'));
    }
}
