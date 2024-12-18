<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class Bahia extends General
{
    private function calcDigit($body, $mod): int
    {
        $weight = strlen($body) + 1;
        $sum = 0;

        foreach (str_split($body) as $digit) {
            $sum += intval($digit) * $weight--;
        }

        $dig = $mod - ($sum % $mod);

        return $dig >= 10 ? 0 : $dig;
    }

    protected function getRegexMask(): string
    {
        return '/^(\d{8,9}|\d{6}-\d{2}|\d{7}-\d{2})$/';
    }

    private function getMod($number): int
    {
        return in_array(
            intval(substr($number, strlen($number) === 9 ? 1 : 0, 1)),
            [0, 1, 2, 3, 4, 5, 8],
            true
        ) ? 10 : 11;
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);
        $length = strlen($sanitized);

        if ($sanitized === '' || intval(substr($sanitized, 0, -2)) === 0) {
            return false;
        }

        $body = substr($sanitized, 0, $length - 2);
        $mod = $this->getMod($sanitized);
        $secondDigit = $this->calcDigit($body, $mod);
        $firstDigit = $this->calcDigit($body . $secondDigit, $mod);
        $pos2dig = strlen($sanitized) - 1;
        $pos1dig = strlen($sanitized) - 2;

        return $sanitized[$pos1dig] == $firstDigit && $sanitized[$pos2dig] == $secondDigit;
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{6}|\d{7})(\d{2})$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
