<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class RioGrandeDoNorte extends General
{
    private function calcDigit(string $number): int
    {
        $weight = strlen($number);
        $sum = 0;

        foreach (str_split(substr($number, 0, -1)) as $digit) {
            $sum += intval($digit) * $weight--;
        }

        $digit = $sum * 10 % 11;

        return $digit === 10 ? 0 : $digit;
    }

    protected function getRegexMask(): string
    {
        return '/^(\d{9,10}|\d{2}(\.\d{3}){2}-\d|\d{2}\.\d(\.\d{3}){2}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return (
            $sanitized === ''
            || substr($sanitized, 0, 2) !== '20'
            || intval(substr($sanitized, 2, -1)) === 0
        )
            ? false
            : intval(substr($sanitized, -1)) === $this->calcDigit($sanitized);
    }

    public function mask(string $number): string
    {
        return $this->maskNine($number) ?: $this->maskTen($number);
    }

    private function maskNine(string $number): string
    {
        return preg_match('/^(\d{2})(\d{3})(\d{3})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '-' . $match[4]
            : '';
    }

    private function maskTen(string $number): string
    {
        return preg_match('/^(\d{2})(\d)(\d{3})(\d{3})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '.' . $match[4] . '-' . $match[5]
            : '';
    }
}
