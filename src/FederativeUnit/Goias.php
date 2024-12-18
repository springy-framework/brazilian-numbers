<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class Goias extends General
{
    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{2}(\.\d{3}){2}-\d)$/';
    }

    private function isBeginValid(string $number): bool
    {
        $intAB = intval(substr($number, 0, 2));

        return $intAB === 10
            || $intAB === 11
            || ($intAB >= 20 && $intAB <= 29);
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || !$this->isBeginValid($sanitized)
            || intval(substr($sanitized, 2, 6)) === 0
        ) {
            return false;
        }

        $weight = 9;
        $sum = 0;

        foreach (str_split(substr($sanitized, 0, 8)) as $item) {
            $sum += intval($item) * $weight--;
        }

        return intval($sanitized[8]) === (($sum %= 11) < 2 ? 0 : 11 - $sum);
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{2})(\d{3})(\d{3})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '-' . $match[4]
            : '';
    }
}
