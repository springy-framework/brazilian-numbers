<?php

namespace Springy\Utils\BrazilianNumbers\Util;

trait Sanitizator
{
    private function sanitize(string $number, string $regexMask): string
    {
        return preg_match($regexMask, $number)
            ? preg_replace('/[^\d]/', '', $number)
            : '';
    }
}
