<?php

namespace Springy\Utils\BrazilianNumbers;

class Cnpj
{
    public static function isValid(string $cnpj): bool
    {
        $sanitized = self::unmask($cnpj);

        if (
            !preg_match('/^([A-Z\d]{12}\d{2}|[A-Z\d]{2}(\.[A-Z\d]{3}){2}\/[A-Z\d]{4}-\d{2})$/', $cnpj)
            || preg_match("/^{$sanitized[0]}{14}$/", $sanitized)
        ) {
            return false;
        }

        // Computes first digit
        $sum1 = 0;
        $sum2 = 0;
        $weight = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0; $i < 12; $i++) {
            $dig = ord($sanitized[$i]) - 48;
            $sum1 += $dig * $weight[$i + 1];
            $sum2 += $dig * $weight[$i];
        }
        $dv1 = $sum1 % 11 < 2 ? 0 : 11 - ($sum1 % 11);
        $sum2 += $dv1 * $weight[12];
        $dv2 = $sum2 % 11 < 2 ? 0 : 11 - ($sum2 % 11);

        return (intval($sanitized[12]) == $dv1) && (intval($sanitized[13]) == $dv2);
    }

    public static function mask(string $cnpj): string
    {
        $sanitized = self::unmask($cnpj);
        preg_match('/^([A-Z\d]{2})([A-Z\d]{3})([A-Z\d]{3})([A-Z\d]{4})(\d{2})$/', $sanitized, $match);

        return self::isValid($cnpj) && $match
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '/' . $match[4] . '-' . $match[5]
            : '';
    }

    public static function unmask(string $cnpj): string
    {
        return preg_replace('/[^A-Z\d]/', '', $cnpj);
    }
}
