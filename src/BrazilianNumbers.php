<?php

class BrazilianNumbers
{
    public function isCnhValid(string $cnh): bool
    {
        if (!preg_match('/\d{11}/', $cnh) || preg_match("/^{$cnh[0]}{11}$/", $cnh)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 9; $i++) {
            $dig += (int) $cnh[$i] * ($i + 2);
        }

        $dg1 = (($dig %= 11) < 2) ? 0 : 11 - $dig;

        if ((int) $cnh[9] != $dg1) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 9; $i++) {
            $dig += (int) ($dg1 . $cnh)[$i] * ($i + 2);
        }

        if ((int) $cnh[10] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        return true;
    }

    public function isCnpjValid(string $cnpj): bool
    {
        if (!preg_match('/\d{14}|\d{2}(\.\d{3}){2}\/\d{4}-\d{2}/', $cnpj)) {
            return false;
        }

        $cnpj = preg_replace('/[^\d]/', '', $cnpj);

        if (preg_match("/^{$cnpj[0]}{14}$/", $cnpj)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 12; $i++) {
            $dig += (int) $cnpj[$i] * (($i < 4 ? 5 : 13) - $i);
        }

        if ((int) $cnpj[12] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 13; $i++) {
            $dig += (int) $cnpj[$i] * (($i < 5 ? 6 : 14) - $i);
        }

        if ((int) $cnpj[13] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        return true;
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
}
