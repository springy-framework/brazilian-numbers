<?php

namespace Springy\Utils\BrazilianNumbers\Util;

trait ModuleEleven
{
    private function calcDigit(string $number, int $weight = 9): int
    {
        $sum = 0;

        foreach (str_split($number) as $digit) {
            $sum += intval($digit) * $weight--;

            if ($weight < 2) {
                $weight = 9;
            }
        }

        return (($sum %= 11) < 2) ? 0 : 11 - $sum;
    }
}
