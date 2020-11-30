<?php

class BrazilianNumbers
{
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
