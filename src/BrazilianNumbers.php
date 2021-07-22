<?php

/**
 * Brazlian Document Numbers Validator.
 *
 * @copyright 2020 Fernando Val
 * @copyright 2020 Springy Framework Team
 * @author    Fernando Val
 * @license   https://github.com/springy-framework/brazilian-numbers/blob/main/LICENSE MIT
 *
 * @version   1.0.0
 */

namespace Springy;

/**
 * Springy\BrazilianNumbers class.
 */
class BrazilianNumbers
{
    protected const PE_NOT_DIGIT = '/[^\d]/';

    public function isCnhValid(string $cnh): bool
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

        return ((int) $cnh[9] == $dg1) && ((int) $cnh[10] == $dg2);
    }

    public function isCnpjValid(string $cnpj): bool
    {
        $sanitized = preg_replace(self::PE_NOT_DIGIT, '', $cnpj);
        if (
            !preg_match('/^(\d{14}|\d{2}(\.\d{3}){2}\/\d{4}-\d{2})$/', $cnpj)
            || preg_match("/^{$sanitized[0]}{14}$/", $sanitized)
        ) {
            return false;
        }

        // Computes first digit
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int) $sanitized[$i] * (($i < 4 ? 5 : 13) - $i);
        }
        $dg1 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        // Computes second digit
        $sum = 0;
        for ($i = 0; $i < 13; $i++) {
            $sum += (int) $sanitized[$i] * (($i < 5 ? 6 : 14) - $i);
        }
        $dg2 = (($sum %= 11) < 2) ? 0 : 11 - $sum;

        return ((int) $sanitized[12] == $dg1) && ((int) $sanitized[13] == $dg2);
    }

    public function isCpfValid(string $cpf): bool
    {
        if (!preg_match('/\d{11}|(\d{3}\.){2}\d{3}-\d{2}/', $cpf)) {
            return false;
        }

        $cpf = preg_replace('/[^\d]/', '', $cpf);

        if (preg_match("/^{$cpf[0]}{11}$/", $cpf)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 9; $i++) {
            $dig += (int) $cpf[$i] * (10 - $i);
        }

        if ((int) $cpf[9] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 10; $i++) {
            $dig += (int) $cpf[$i] * (11 - $i);
        }

        if ((int) $cpf[10] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        return true;
    }

    public function isNisValid(string $nis): bool
    {
        if (!preg_match('/\d{11}|\d{3}\.\d{5}\.\d{2}-\d/', $nis)) {
            return false;
        }

        $nis = preg_replace('/[^\d]/', '', $nis);

        if (preg_match("/^{$nis[0]}{11}$/", $nis)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 10; $i++) {
            $dig += (int) $nis[$i] * (($i < 2 ? 3 : 11) - $i);
        }

        return (int) $nis[10] == (((10 * $dig) % 11) % 10);
    }
}
