<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Para extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{2}-\d{6}-\d|\d{8}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return (
            $sanitized === ''
            || !in_array(intval(substr($sanitized, 0, 2)), [15, 75, 76, 77, 78, 79], true)
            || intval(substr($sanitized, 2, 6)) === 0
        )
            ? false
            : intval($sanitized[8]) === $this->calcDigit(substr($sanitized, 0, 8));
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{2})(\d{6})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2] . '-' . $match[3]
            : '';
    }
}
