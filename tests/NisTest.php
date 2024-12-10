<?php

/**
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Springy\Utils\BrazilianNumbers\Nis;

final class NisTest extends TestCase
{
    public function testMaskUnmask()
    {
        $this->assertEquals(Nis::unmask('640.58791.38-4'), '64058791384');
        $this->assertEquals(Nis::mask('64058791384'), '640.58791.38-4');
    }

    public function testInvalidNis()
    {
        $this->assertFalse(Nis::isValid(''));
        $this->assertFalse(Nis::isValid('000'));
        $this->assertFalse(Nis::isValid('11111111111'));
        $this->assertFalse(Nis::isValid('640.58791.384'));
        $this->assertFalse(Nis::isValid('64058791385'));
        $this->assertFalse(Nis::isValid('64o58791384'));
    }

    public function testValidNis()
    {
        $this->assertTrue(Nis::isValid('64058791384'));
        $this->assertTrue(Nis::isValid('640.58791.38-4'));
    }
}
