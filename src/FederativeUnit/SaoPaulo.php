<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

class SaoPaulo extends General
{
    private function calcDig1IndCom(string $number): int
    {
        $sum = 0;
        $weights = [1, 3, 4, 5, 6, 7, 8, 10];

        foreach (str_split(substr($number, 0, 8)) as $idx => $item) {
            $sum += intval($item) * $weights[$idx];
        }

        return intval(substr(strval($sum % 11), -1));
    }

    private function calcDig2IndCom(string $number): int
    {
        $sum = 0;
        $weight = 3;

        foreach (str_split(substr($number, 0, 11)) as $item) {
            $sum += intval($item) * $weight--;

            if ($weight < 2) {
                $weight = 10;
            }
        }

        return intval(substr(strval($sum % 11), -1));
    }

    protected function getRegexMask(): string
    {
        return '/^(\d{12}|\d{3}(\.\d{3}){3}|P\d{12}|P-\d{8}\.\d\/\d{3})$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->sanitize($number, $this->getRegexMask());

        return match (true) {
            $sanitized === '' => false,
            substr($sanitized, 0, 1) === 'P' => intval($sanitized[9]) === $this->calcDig1IndCom(substr($sanitized, 1)),
            default => intval($sanitized[8]) === $this->calcDig1IndCom($sanitized)
                && intval($sanitized[11]) === $this->calcDig2IndCom($sanitized)
        };
    }

    private function sanitize(string $number, string $regexMask): string
    {
        return preg_match($regexMask, $number)
            ? preg_replace('/[^P\d]/', '', $number)
            : '';
    }

    public function mask(string $number): string
    {
        return $this->maskIndCom($number) ?: $this->maskRural($number);
    }

    private function maskIndCom(string $number): string
    {
        return preg_match('/^(\d{3})(\d{3})(\d{3})(\d{3})$/', $this->sanitize($number, $this->getRegexMask()), $match)
            ? $match[1] . '.' . $match[2] . '.' . $match[3] . '.' . $match[4]
            : '';
    }

    private function maskRural(string $number): string
    {
        return preg_match('/^P(\d{8})(\d)(\d{3})$/', $this->sanitize($number, $this->getRegexMask()), $match)
            ? 'P-' . $match[1] . '.' . $match[2] . '/' . $match[3]
            : '';
    }

    public function unmask(string $number): string
    {
        return $this->sanitize($number, $this->getRegexMask());
    }
}
