<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Rondonia extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        // return '/^(\d{9}|\d{3}\.\d{5}-\d)$/';
        return '/^(\d{14}|\d{13}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return $sanitized === '' || intval(substr($sanitized, 0, -1)) === 0
            ? false
            : intval(substr($sanitized, -1)) === $this->calcDigit(substr($sanitized, 0, -1), 6);
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{13})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
