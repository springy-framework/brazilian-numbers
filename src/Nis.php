<?php

namespace Springy\Utils\BrazilianNumbers;

class Nis
{
    public static function isValid(string $nis): bool
    {
        $sanitized = self::unmask($nis);

        if (
            !preg_match('/^(\d{11}|\d{3}\.\d{5}\.\d{2}-\d)$/', $nis)
            || preg_match("/^{$sanitized[0]}{11}$/", $sanitized)
        ) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += intval($sanitized[$i]) * (($i < 2 ? 3 : 11) - $i);
        }

        return intval($sanitized[10]) == (((10 * $sum) % 11) % 10);
    }

    public static function mask(string $nis): string
    {
        $sanitized = self::unmask($nis);
        preg_match('/^(\d{3})(\d{5})(\d{2})(\d)$/', $sanitized, $match);

        return self::isValid($nis) && $match
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '-' . $match[4]
            : '';
    }

    public static function unmask(string $nis): string
    {
        return preg_replace('/[^\d]/', '', $nis);
    }
}
