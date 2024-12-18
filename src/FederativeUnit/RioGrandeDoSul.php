<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class RioGrandeDoSul extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{10}|\d{3}\/\d{7})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return (
            $sanitized === ''
            || intval(substr($sanitized, 0, 3)) === 0
            || intval(substr($sanitized, 3, 6)) === 0
        )
            ? false
            : intval($sanitized[9]) === $this->calcDigit(substr($sanitized, 0, -1), 2);
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{3})(\d{7})$/', $this->unmask($number), $match)
            ? $match[1] . '/' . $match[2]
            : '';
    }
}
