<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class MinasGerais extends General
{
    private function calcFirstDigit(string $body): int
    {
        $trail = '';

        foreach (str_split(substr_replace($body, '0', 3, 0)) as $idx => $item) {
            $trail .= strval(intval($item) * ($idx % 2 === 0 ? 1 : 2));
        }

        $sum = strval(
            array_reduce(
                str_split($trail),
                fn (int $carry, string $number) => $carry + intval($number),
                0
            )
        );

        $last = intval(substr($sum, -1));

        return $last === 0 ? 0 : 10 - $last;
    }

    private function calcSecondDigit(string $body): int
    {
        $weight = 3;
        $sum = 0;

        foreach (str_split($body) as $item) {
            $sum += intval($item) * $weight--;

            if ($weight < 2) {
                $weight = 11;
            }
        }

        return (($sum %= 11) < 2) ? 0 : 11 - $sum;
    }

    protected function getRegexMask(): string
    {
        return '/^(\d{13}|\d{3}(\.\d{3}){2}\/\d{4})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        if (
            $sanitized === ''
            || intval(substr($sanitized, 0, 3)) === 0
            || intval(substr($sanitized, 3, 6)) === 0
            || preg_match("/^{$sanitized[0]}{13}$/", $sanitized)
        ) {
            return false;
        }

        $body = substr($sanitized, 0, 11);
        $dig1 = $this->calcFirstDigit($body);
        $dig2 = $this->calcSecondDigit($body . strval($dig1));

        return intval($sanitized[11]) === $dig1 && intval($sanitized[12]) === $dig2;
    }

    public function mask(string $number): string
    {
        return preg_match('/^(\d{3})(\d{3})(\d{3})(\d{4})$/', $this->unmask($number), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '/' . $match[4]
            : '';
    }
}
