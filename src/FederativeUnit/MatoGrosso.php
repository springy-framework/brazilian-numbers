<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class MatoGrosso extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{11}|\d{10}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return $sanitized === '' || intval(substr($sanitized, 0, -1)) === 0
            ? false
            : intval($sanitized[10]) === $this->calcDigit(substr($sanitized, 0, 10), 3);
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{10})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
