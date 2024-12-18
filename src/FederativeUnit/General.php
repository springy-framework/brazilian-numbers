<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\Sanitizator;

abstract class General
{
    use Sanitizator;

    abstract protected function getRegexMask(): string;

    abstract public function isValid(string $number): bool;

    abstract public function mask(string $number): string;

    public function unmask(string $number): string
    {
        return $this->sanitize($number, $this->getRegexMask());
    }
}
