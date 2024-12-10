<?php

/**
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Springy\Utils\BrazilianNumbers\Cnh;

final class CnhTest extends TestCase
{
    public function testInvalidCnh()
    {
        $this->assertFalse(Cnh::isValid(''));
        $this->assertFalse(Cnh::isValid('000'));
        $this->assertFalse(Cnh::isValid('11111111111'));
        $this->assertFalse(Cnh::isValid('2i059294129'));
        $this->assertFalse(Cnh::isValid('21059294120'));
    }

    public function testValidCnh()
    {
        $this->assertTrue(Cnh::isValid('21059294129'));
    }
}
