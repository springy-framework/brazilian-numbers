<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\HasNoMask;

class Alagoas extends General
{
    use HasNoMask;

    protected function getRegexMask(): string
    {
        return '/^\d{9}$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || substr($sanitized, 0, 2) !== '24'
            || !in_array(intval(substr($sanitized, 2, 1)), [0, 3, 5, 7, 8], true)
            || substr($sanitized, 3, 5) === '00000'
        ) {
            return false;
        }

        $weight = 9;
        $sum = 0;

        for ($i = 0; $i < 8; $i++) {
            $sum += intval($sanitized[$i]) * $weight--;
        }

        $product = $sum * 10;
        $dig = $product - (intval($product / 11) * 11);

        if ($dig >= 10) {
            $dig = 0;
        }

        return $dig === intval($sanitized[8]);
    }
}
