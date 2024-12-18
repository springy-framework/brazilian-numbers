<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Pernambuco extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{7}-\d{2})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || intval(substr($sanitized, 0, -1)) === 0
        ) {
            return false;
        }

        $body = substr($sanitized, 0, 7);
        $dig1 = $this->calcDigit($body, 8);
        $dig2 = $this->calcDigit($body . strval($dig1));

        return intval($sanitized[7]) == $dig1 && intval($sanitized[8]) === $dig2;
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{7})(\d{2})$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
