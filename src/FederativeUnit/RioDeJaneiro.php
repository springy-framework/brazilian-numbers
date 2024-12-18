<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class RioDeJaneiro extends General
{
    private function calcDigit(string $number): int
    {
        $weight = 2;
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
        return '/^(\d{8}|\d{2}\.\d{3}\.\d{2}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return $sanitized === '' || intval(substr($sanitized, 0, -1)) === 0
            ? false
            : intval($sanitized[7]) == $this->calcDigit(substr($sanitized, 0, 7));
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{2})(\d{3})(\d{2})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '-' . $match[4]
            : '';
    }
}
