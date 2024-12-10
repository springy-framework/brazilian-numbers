# PHP Brazilian Numbers Validation

This package can validate documents like CPF, CNPJ, CNH and NIS.

It can take the strings with the numbers of documents of people and companies
from Brazil and perform format and check digit verifications to determine if
they can be valid.

[![Latest Stable Version](https://poser.pugx.org/springy-framework/brazilian-numbers/v/stable)](https://packagist.org/packages/springy-framework/brazilian-numbers)
[![Tests](https://github.com/springy-framework/brazilian-numbers/actions/workflows/php.yml/badge.svg)](https://github.com/springy-framework/brazilian-numbers/actions/workflows/php.yml)
[![Total Downloads](https://poser.pugx.org/springy-framework/brazilian-numbers/downloads)](https://packagist.org/packages/springy-framework/brazilian-numbers)
[![License](https://poser.pugx.org/springy-framework/brazilian-numbers/license)](https://packagist.org/packages/springy-framework/brazilian-numbers)

## Requirements

- PHP 8.1+

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

// The following numbers can also be used without a mask.
$cpf = '899.678.736-12';
$cnpj = '76.871.442/0001-75';
$cnh = '21059294129';
$nis = '640.58791.38-4';

if (Springy\Utils\BrazilianNumbers\Cpf::isValid($cpf)) {
    echo "CPF valid!\n";
} else {
    echo "CPF invalid!\n";
}

if (Springy\Utils\BrazilianNumbers\Cnpj::isValid($cnpj)) {
    echo "CNPJ valid!\n";
} else {
    echo "CNPJ invalid!\n";
}

if (Springy\Utils\BrazilianNumbers\Cnh::isValid($cnh)) {
    echo "CNH valid!\n";
} else {
    echo "CNH invalid!\n";
}

if (Springy\Utils\BrazilianNumbers\Nis::isValid($nis)) {
    echo "NIS valid!\n";
} else {
    echo "NIS invalid!\n";
}

echo Springy\Utils\BrazilianNumbers\Cpf::mask('89967873612');
echo Springy\Utils\BrazilianNumbers\Cnpj::mask('76871442000175');
echo Springy\Utils\BrazilianNumbers\Nis::mask('64058791384');
echo Springy\Utils\BrazilianNumbers\Cpf::unmask($cpf);
echo Springy\Utils\BrazilianNumbers\Cnpj::unmask($cnpj);
echo Springy\Utils\BrazilianNumbers\Nis::unmask($nis);
```

## Contributing

Please read our [contributing](/CONTRIBUTING.md) document and thank you for
doing that.

## Code of Conduct

In order to ensure that our community is welcoming to all, please review and
abide by the [code of conduct](/CODE_OF_CONDUCT.md).

## License

This project is licensed under [The MIT License (MIT)](/LICENSE).
