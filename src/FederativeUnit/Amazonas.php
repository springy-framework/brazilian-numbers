<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class Amazonas extends General
{
    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{2}(\.\d{3}){2}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if ($sanitized === '' || intval(substr($sanitized, 0, -1)) === 0) {
            return false;
        }

        $sum = 0;
        $weight = 9;

        foreach (str_split(substr($sanitized, 0, 8)) as $item) {
            $sum += intval($item) * $weight--;
        }

        $dig = ($sum < 11)
            ? 11 - $sum
            : (($sum %= 11) < 2 ? 0 : 11 - $sum);

        return $dig === intval($sanitized[8]);
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{2})(\d{3})(\d{3})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '-' . $match[4]
            : '';
    }
}
