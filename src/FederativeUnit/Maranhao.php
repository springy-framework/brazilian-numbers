<?php

namespace Springy\Utils\BrazilianNumbers\FederativeUnit;

use Springy\Utils\BrazilianNumbers\Util\ModuleEleven;

class Maranhao extends Ceara
{
    use ModuleEleven;

    protected function getRegexMask(): string
    {
        return '/^(\d{9}|\d{8}-\d)$/';
    }

    public function isValid(string $number): bool
    {
        $sanitized = $this->unmask($number);

        return (
            $sanitized === ''
            || substr($number, 0, 2) !== '12'
            || intval(substr($sanitized, 2, -1)) === 0
        )
            ? false
            : intval($sanitized[8]) === $this->calcDigit(substr($sanitized, 0, 8));
    }
}
