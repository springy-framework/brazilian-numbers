<?php

/**
 * @see http://www.sintegra.gov.br/insc_est.html
 */

namespace Springy\Utils\BrazilianNumbers;

use Exception;
use Springy\Utils\BrazilianNumbers\FederativeUnit\General;

class InscricaoEstadual
{
    private static function factory(string $state): General
    {
        $class = 'Springy\\Utils\\BrazilianNumbers\\FederativeUnit\\' . (
            [
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapa',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceara',
                'DF' => 'DistritoFederal',
                'ES' => 'Ceara',
                'GO' => 'Goias',
                'MA' => 'Maranhao',
                'MT' => 'MatoGrosso',
                'MS' => 'MatoGrossoDoSul',
                'MG' => 'MinasGerais',
                'PA' => 'Para',
                'PB' => 'Ceara',
                'PR' => 'Parana',
                'PE' => 'Pernambuco',
                'PI' => 'Ceara',
                'RJ' => 'RioDeJaneiro',
                'RN' => 'RioGrandeDoNorte',
                'RS' => 'RioGrandeDoSul',
                'RO' => 'Rondonia',
                'RR' => 'Roraima',
                'SC' => 'SantaCatarina',
                'SP' => 'SaoPaulo',
                'SE' => 'Ceara',
                'TO' => 'Tocantins',
            ][$state] ?? ''
        );

        if (!class_exists($class)) {
            throw new Exception('Unknown federative unit ');
        }

        return new $class();
    }

    public static function isValid(string $ufsg, string $number): bool
    {
        return self::factory($ufsg)->isValid($number);
    }

    public static function mask(string $ufsg, string $number): string
    {
        return self::isValid($ufsg, $number)
            ? self::factory($ufsg)->mask($number)
            : '';
    }

    public static function unmask(string $ufsg, string $number): string
    {
        return self::factory($ufsg)->unmask($number);
    }
}
