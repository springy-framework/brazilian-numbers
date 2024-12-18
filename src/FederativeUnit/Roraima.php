<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class Roraima extends General
{
    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{8}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || substr($sanitized, 0, 2) !== '24'
            || !intval(substr($sanitized, 2, -1)) === 0
        ) {
            return false;
        }

        $weight = 1;

        return intval(substr($sanitized, -1)) === array_reduce(
            str_split(substr($sanitized, 0, -1)),
            fn (int $carry, string $item) => $carry + (intval($item) * $weight++),
            0
        ) % 9;
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{8})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
