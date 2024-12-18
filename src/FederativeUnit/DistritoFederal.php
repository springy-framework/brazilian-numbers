<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class DistritoFederal extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{13}|\d{11}-\d{2})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || !in_array(substr($sanitized, 0, 2), ['07', '08'])
            || intval(substr($sanitized, 2, 6)) === 0
            || intval(substr($sanitized, 8, 3)) === 0
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
        return preg_match('/^(\d{11})(\d{2})$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
