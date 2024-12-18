<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Ceara extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{8}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return $sanitized === '' || intval(substr($sanitized, 0, -1)) === 0
            ? false
            : intval($sanitized[8]) === $this->calcDigit(substr($sanitized, 0, 8));
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{8})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
