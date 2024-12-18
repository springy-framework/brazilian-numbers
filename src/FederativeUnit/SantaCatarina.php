<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class SantaCatarina extends Ceara
{
    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{3}(\.\d{3}){2})$/';
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{3})(\d{3})(\d{3})$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3]
            : '';
    }
}
