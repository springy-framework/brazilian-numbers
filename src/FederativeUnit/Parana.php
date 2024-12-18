<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class Parana extends General
{
    private function calcDigit(string $number): int
    {
        $weight = strlen($number) - 5;
        $sum = 0;

        foreach (str_split($number) as $digit) {
            $sum += intval($digit) * $weight--;

            if ($weight < 2) {
                $weight = 7;
            }
        }

        return (($sum %= 11) < 2) ? 0 : 11 - $sum;
    }

    protected function getRegexMask(): string
    {
        return '/^(\d{10}|\d{8}-\d{2}|\d{3}\.\d{5}-\d{2})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || intval(substr($sanitized, 0, -2)) === 0
        ) {
            return false;
        }

        $body = substr($sanitized, 0, 8);
        $dig1 = $this->calcDigit($body);
        $dig2 = $this->calcDigit($body . strval($dig1));

        return intval($sanitized[8]) == $dig1 && intval($sanitized[9]) === $dig2;
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{3})(\d{5})(\d{2})$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '-' . $match[3]
            : '';
    }
}
