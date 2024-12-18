<?php

namespace Springy\Utils\BrazilianNumbers;

class Cnh
{
    public static function isValid(string $cnh): bool
    {
        if (!preg_match('/^\d{11}$/', $cnh) || preg_match("/^{$cnh[0]}{11}$/", $cnh)) {
            return false;
        }

        // Computes first digit
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $cnh[$i] * ($i + 2);
        }
        $dg1 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        // Computes second digit
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) ($dg1 . $cnh)[$i] * ($i + 2);
        }
        $dg2 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        return (intval($cnh[9]) == $dg1) && (intval($cnh[10]) == $dg2);
    }
}
