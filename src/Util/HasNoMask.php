<?php

namespace Springy\Utils\BrazilianNumbers\Util;

trait HasNoMask
{
    public function mask(string $number): string
    {
        return preg_match('/^\d+$/', $number) ? $number : '';
    }
}
