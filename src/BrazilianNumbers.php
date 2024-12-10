<?php

/**
 * Brazlian Document Numbers Validator.
 *
 * @copyright 2020 Fernando Val
 * @copyright 2020 Springy Framework Team
 * @author    Fernando Val
 * @license   https://github.com/springy-framework/brazilian-numbers/blob/main/LICENSE MIT
 *
 * @version   2.0.0
 */

namespace Springy;

use Springy\Utils\BrazilianNumbers\Cnpj;
use Springy\Utils\BrazilianNumbers\Cnh;
use Springy\Utils\BrazilianNumbers\Cpf;
use Springy\Utils\BrazilianNumbers\Nis;

/**
 * Springy\BrazilianNumbers class.
 */
class BrazilianNumbers
{
    public function isCnhValid(string $cnh): bool
    {
        return Cnh::isValid($cnh);
    }

    public function isCnpjValid(string $cnpj): bool
    {
        return Cnpj::isValid($cnpj);
    }

    public function isCpfValid(string $cpf): bool
    {
        return Cpf::isValid($cpf);
    }

    public function isNisValid(string $nis): bool
    {
        return Nis::isValid($nis);
    }
}
