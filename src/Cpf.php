<?php

namespace Springy\Utils\BrazilianNumbers;

class Cpf
{
    public static function isValid(string $cpf): bool
    {
        $sanitized = self::unmask($cpf);

        if (
            !preg_match('/^(\d{11}|(\d{3}\.){2}\d{3}-\d{2})$/', $cpf)
            || preg_match("/^{$sanitized[0]}{11}$/", $sanitized)
        ) {
            return false;
        }

        // Computes first digit
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += intval($sanitized[$i]) * (10 - $i);
        }
        $dg1 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        // Computes second digit
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($sanitized[$i]) * (11 - $i);
        }
        $dg2 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        return (intval($sanitized[9]) == $dg1) && (intval($sanitized[10]) == $dg2);
    }

    public static function mask(string $cpf): string
    {
        $sanitized = self::unmask($cpf);
        preg_match('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', $sanitized, $match);

        return self::isValid($cpf) && $match
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '-' . $match[4]
            : '';
    }

    public static function unmask(string $cpf): string
    {
        return preg_replace('/[^\d]/', '', $cpf);
    }
}
