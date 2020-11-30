<?php

class BrazilianNumbers
{
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
            $dig += $cnpj[$i] * (($i < 4 ? 5 : 13) - $i);
        }

        if ($cnpj[12] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 13; $i++) {
            $dig += $cnpj[$i] * (($i < 5 ? 6 : 14) - $i);
        }

        if ($cnpj[13] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
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
            $dig += $cpf[$i] * (10 - $i);
        }

        if ($cpf[9] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        $dig = 0;
        for ($i = 0; $i < 10; $i++) {
            $dig += $cpf[$i] * (11 - $i);
        }

        if ($cpf[10] != ((($dig %= 11) < 2) ? 0 : 11 - $dig)) {
            return false;
        }

        return true;
    }
}
