<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\HasNoMask;

class Amapa extends General
{
    use HasNoMask;

    private function getDValue(string $number): int
    {
        $value = intval($number);

        return 3017001 <= $value && $value <= 3019022 ? 1 : 0;
    }

    private function getPValue(string $number): int
    {
        $value = intval($number);

        return match (true) {
            $value <= 3017000 => 5,
            $value <= 3019022 => 9,
            default => 0
        };
    }

    protected function getRegexMask(): string
    {
        return '/^\d{9}$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || substr($sanitized, 0, 2) !== '03'
            || intval(substr($sanitized, 2, 6)) === 0
        ) {
            return false;
        }

        $weight = 9;
        $body = substr($sanitized, 0, 8);
        $sum = $this->getPValue($body);

        foreach (str_split($body) as $item) {
            $sum += intval($item) * $weight--;
        }

        $mod = 11 - ($sum % 11);
        $dig = ($mod === 10) ? 0 : ($mod === 11 ? $this->getDValue($body) : $mod);

        return $dig === intval($sanitized[8]);
    }
}
