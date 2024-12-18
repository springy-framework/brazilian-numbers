<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Tocantins extends General
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{11}|\d{8}-\d|\d{10}-\d)$/';
    }

    private function isTypeValid(string $number): bool
    {
        return in_array(
            strlen($number) === 9 ? '99' : substr($number, 2, 2),
            ['01', '02', '03', '99'],
            true
        );
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return ($sanitized === '' || !$this->isTypeValid($sanitized))
            ? false
            : intval(substr($sanitized, -1)) === $this->calcDigit(
                substr(
                    strlen($sanitized) === 9 ? $sanitized : substr_replace($sanitized, '', 2, 2),
                    0,
                    -1
                )
            );
    }

    public function mask(string $number): string
    {
        return $this->maskEleven($number) ?: $this->maskNine($number);
    }

    private function maskEleven(string $number): string
    {
        return preg_match('/^(\d{10})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }

    private function maskNine(string $number): string
    {
        return preg_match('/^(\d{8})(\d)$/', $this->unmask($number), $match)
            ? $match[1] . '-' . $match[2]
            : '';
    }
}
