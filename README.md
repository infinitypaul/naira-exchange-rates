# Naira ExchangeRatesAPI - Naira Currency Exchange Rates API SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/infinitypaul/naira-exchange-rates.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/naira-exchange-rates)
[![Build Status](https://img.shields.io/travis/infinitypaul/naira-exchange-rates/master.svg?style=flat-square)](https://travis-ci.org/infinitypaul/naira-exchange-rates)
[![Quality Score](https://img.shields.io/scrutinizer/g/infinitypaul/naira-exchange-rates.svg?style=flat-square)](https://scrutinizer-ci.com/g/infinitypaul/naira-exchange-rates)
[![Total Downloads](https://img.shields.io/packagist/dt/infinitypaul/naira-exchange-rates.svg?style=flat-square)](https://packagist.org/packages/infinitypaul/naira-exchange-rates)

 Free Naira Exchange Rates API, which provides past or recent exchange rate lookups. It features a number of useful functions and can be installed easily using Composer..

## Installation

You can install the package via composer:

```bash
composer require infinitypaul/naira-exchange-rates
```
Alternatively, you can download all files from the src/ directory and include them in your project. Important note: if you're manually installing the SDK, you must also install Guzzle Client.

## Usage

The Naira Currency Exchange API does require API keys or authentication in order to access and interrogate its API, Register and get your token on http://nairaexchangerate.herokuapp.com/.

**Basic usage:**<br />

Fetch the latest exchange rates 
``` php
$naira = new NairaExchangeRates
$rates  = $naira->setType('cbn')->fetch();
```

**Historical Data:**<br />
Get historical rates for any day since 1999:
``` php
$naira = new NairaExchangeRates
$rates  = $naira->setType('cbn')->addDateFrom('2019-11-26')->fetch();
```

**Fetch Specific Rate:**<br />
If you do not want all current rates, it's possible to specify only the currencies you want
``` php
$naira = new NairaExchangeRates
$rates  = $naira->setType('cbn')->setBaseCurrency('usd')->fetch();
```

### 4. API Reference:

The following API reference lists the publicly-available methods for the 

#### `NairaExchangeRatesAPI` Reference:

`addDateFrom( string $from )`:<br />
Set the date from which to retrieve historic rates. `$from` should be a string containing an ISO 8601 date.

`setType( string $to )`:<br />
Set The Exchange Rate Type You Want To Retrieve, we have the following types
1. `cbn` Central Bank Of Nigeria Rate
2. `bdc` Burueu The Change Rate
3. `bank` Bank Rate
4. `moneygram` MoneyGram Rate
5. `westernunion` Western Union Rate



`addDateTo( string $type )`:<br />
Set the end date for the retrieval of historic rates. `$to` should be a string containing an ISO 8601 date.

`setBaseCurrency( string $code )`:<br />
Set the base currency you want to retrieve. `$code` should be passed an ISO 4217 code (e.g. `EUR`).<br />
`$code` must be one of the [supported currency codes](#5-supported-currencies).


`fetch()`:<br />
Send off the request to the API and return either a Json,

### 5. Supported Currencies:

The library supports the following currencies USD, GBP, EUR, JPY, XAF, CNY, QAR, ZAR, SEK:


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Bug & Features

If you have spotted any bugs, or would like to request additional features from the library, please file an issue via the Issue Tracker on the project's Github page: [https://github.com/infinitypaul/naira-exchange-rates/issues](https://github.com/infinitypaul/naira-exchange-rate/issues).

## Credits

- [Paul Edward](https://github.com/infinitypaul)
- [Olutoye Owojaye](https://github.com/teeto4517)
- [All Contributors](../../contributors)

## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/infinitypaul)!

Thanks!<br>
Edward Paul.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


