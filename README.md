ExchangeRate
============

[![License](https://poser.pugx.org/ossbrownie/exchange-rate/license)](https://packagist.org/packages/ossbrownie/exchange-rate)
[![Latest Stable Version](https://poser.pugx.org/ossbrownie/exchange-rate/v/stable)](https://packagist.org/packages/ossbrownie/exchange-rate)
[![Latest Unstable Version](https://poser.pugx.org/ossbrownie/exchange-rate/v/unstable)](https://packagist.org/packages/ossbrownie/exchange-rate)
[![Total Downloads](https://poser.pugx.org/ossbrownie/exchange-rate/downloads)](https://packagist.org/packages/ossbrownie/exchange-rate)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ossbrownie/exchange-rate/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ossbrownie/exchange-rate/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/ossbrownie/exchange-rate/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/ossbrownie/exchange-rate/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/ossbrownie/exchange-rate/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Build Status](https://travis-ci.org/ossbrownie/exchange-rate.svg?branch=master)](https://travis-ci.org/ossbrownie/exchange-rate)

[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.0-brightgreen.svg)](https://php.net/)

Allows you to receive current exchange rates from various sources and convert them.

## Requirements
- **PHP** = >= 7.0
- **EXT-CURL** = *
- **EXT-SIMPLEXML** = *
- **EXT-LIBXML** = *
- **ossbrownie/http-client** = 0.0.7

For more information about the extensions see:

**curl** - [https://www.php.net/curl](https://www.php.net/curl)

**libxml** - [https://www.php.net/libxml](https://www.php.net/libxml)

**simplexml** - [https://www.php.net/simplexml](https://www.php.net/simplexml)


## Installation
Add a line to your "require" section in your composer configuration:
```json
{
    "require": {
        "ossbrownie/exchange-rate": "0.0.1"
    }
}
```


## Documentation
- [Getting a base list of currencies.](https://github.com/ossbrownie/exchange-rate/wiki/Usage)
- [Getting exchange currency rates.](https://github.com/ossbrownie/exchange-rate/wiki/Usage)
- [Exchange currency.](https://github.com/ossbrownie/exchange-rate/wiki/ExchangeCurrency)


## Tests
To run the test suite, you need install the dependencies via composer, then run PHPUnit.
```bash
$> composer.phar install
$> ./vendor/bin/phpunit --bootstrap ./tests/bootstrap.php ./tests
```


## License
ExchangeRate is licensed under the [MIT License](https://opensource.org/licenses/MIT)


## Contact
Problems, comments, and suggestions all welcome: [oss.brownie@gmail.com](mailto:oss.brownie@gmail.com)
