<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class MatoGrossoDoSul extends Ceara
{
    use ModuleEleven;

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return (
            $sanitized === ''
            || !in_array(substr($sanitized, 0, 2), ['28', '50'])
            || intval(substr($sanitized, 2, -1)) === 0
        )
            ? false
            : intval($sanitized[8]) === $this->calcDigit(substr($sanitized, 0, 8));
    }
}
