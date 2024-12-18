<?php

/**
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Springy\BrazilianNumbers;

final class XlegacyTest extends TestCase
{
    public function testLegacyValidation()
    {
        $legacy = new BrazilianNumbers();

        $this->assertTrue($legacy->isCnhValid('21059294129'));
        $this->assertTrue($legacy->isCnpjValid('76.871.442/0001-75'));
        $this->assertTrue($legacy->isCpfValid('899.678.736-12'));
        $this->assertTrue($legacy->isNisValid('640.58791.38-4'));
    }
}
