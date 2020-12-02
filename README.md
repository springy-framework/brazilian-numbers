# Springy BrazilianNumbers

Brazilian documents and numbers validator for PHP.

[![Latest Stable Version](https://poser.pugx.org/springy-framework/brazilian-numbers/v/stable)](https://packagist.org/packages/springy-framework/brazilian-numbers)
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/bf5ff92d1ecb484cbef2ec2c58f0b373)](https://www.codacy.com/gh/springy-framework/brazilian-numbers/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=springy-framework/brazilian-numbers&amp;utm_campaign=Badge_Grade)
[![Build Status](https://travis-ci.org/springy-framework/brazilian-numbers.svg?branch=main)](https://travis-ci.org/springy-framework/brazilian-numbers)
![PHP Composer](https://github.com/springy-framework/brazilian-numbers/workflows/PHP%20Composer/badge.svg)
[![StyleCI](https://github.styleci.io/repos/317241593/shield)](https://github.styleci.io/repos/317241593)
[![Total Downloads](https://poser.pugx.org/springy-framework/brazilian-numbers/downloads)](https://packagist.org/packages/springy-framework/brazilian-numbers)
[![License](https://poser.pugx.org/springy-framework/brazilian-numbers/license)](https://packagist.org/packages/springy-framework/brazilian-numbers)

> **WARNING!** This project is still a work in progress.

## Requirements

-   PHP 7.2+

## Instalation

To get the latest stable version of this component use:

```json
"require": {
    "springy-framework/brazilian-numbers": "*"
}
```

in your composer.json file.

## Usage

I suppose that the following example is all you need:

```php
<?php

require 'vendor/autoload.php'; // If you're using Composer (recommended)

$brNum = new Springy\BrazilianNumbers();

// The following numbers can also be used without a mask.
$cpf = '899.678.736-12';
$cnpj = '76.871.442/0001-75';
$cnh = '21059294129';
$nis = '640.58791.38-4';

if ($brNum->isCpfValid($cpf)) {
    echo "CPF valid!\n";
} else {
    echo "CPF invalid!\n";
}

if ($brNum->isCnpjValid($cnpj)) {
    echo "CNPJ valid!\n";
} else {
    echo "CNPJ invalid!\n";
}

if ($brNum->isCnhValid($cnh)) {
    echo "CNH valid!\n";
} else {
    echo "CNH invalid!\n";
}

if ($brNum->isNisValid($nis)) {
    echo "NIS valid!\n";
} else {
    echo "NIS invalid!\n";
}
```

## License

This project is licensed under [The MIT License (MIT)](/LICENSE).
