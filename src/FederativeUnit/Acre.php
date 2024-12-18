<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Acre extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{13}|(\d{2})(\.\d{3}){2}\/\d{3}-\d{2})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || substr($sanitized, 0, 2) !== '01'
            || substr($sanitized, 2, 6) === '000'
            || substr($sanitized, 8, 3) === '000'
        ) {
            return false;
        }

        $body = substr($sanitized, 0, 11);
        $dig1 = $this->calcDigit($body, 4);
        $dig2 = $this->calcDigit($body . $dig1, 5);

        return intval($sanitized[11]) === $dig1 && intval($sanitized[12]) === $dig2;
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{2})(\d{3})(\d{3})(\d{3})(\d{2})$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '/' . $match[4] . '-' . $match[5]
            : '';
    }
}
