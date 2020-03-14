<?php

namespace Infinitypaul\NairaExchangeRates\Traits;

use Infinitypaul\NairaExchangeRates\Exceptions\Exceptions;

trait CurrencyTraits
{
    // Supported currencies:
    private $_currencies = [
        'USD', 'GBP', 'EUR', 'JPY', 'XAF', 'CNY', 'QAR', 'ZAR', 'SEK',
    ];

    // The base currency (default is USD):
    private $baseCurrency;

    // Regular Expression for the currency:
    private $currencyRegExp = '/^[A-Z]{3}$/';


    // Sanitize a currency code:
    private function sanitizeCurrencyCode(string $code)
    {
        return trim(
            strtoupper($code)
        );
    }

    // Set the base currency:
    public function setBaseCurrency(string $currency)
    {
        // Sanitize the code:
        $currencyCode = $this->sanitizeCurrencyCode($currency);

        // Is it valid?
        $this->verifyCurrencyCode($currencyCode);

        $this->baseCurrency = $currencyCode;

        // Return object to preserve method-chaining:
        return $this;
    }

    // Runs tests to verify a currency code:
    private function verifyCurrencyCode(string $code)
    {
        $currencyCode = $this->sanitizeCurrencyCode($code);

        // Is the currency code in ISO 4217 format?
        if (! $this->validateCurrencyCodeFormat($currencyCode)) {
            throw Exceptions::create('format.invalid_currency_code');
        }

        // Is it a supported currency?
        if (! $this->currencyIsSupported($currencyCode)) {
            throw Exceptions('format.unsupported_currency');
        }
    }

    // Validate a currency code is in the correct format:
    private function validateCurrencyCodeFormat(string $code = null)
    {
        if (! is_null($code)) {
            // Is the string longer than 3 characters?
            if (strlen($code) != 3) {
                return false;
            }

            // Does it contain non-alphabetical characters?
            if (! preg_match($this->currencyRegExp, $code)) {
                return false;
            }

            return true;
        }

        return false;
    }

    // Check if a currency code is in the supported range:
    public function currencyIsSupported(string $code)
    {
        $currencyCode = $this->sanitizeCurrencyCode($code);

        if (! $this->validateCurrencyCodeFormat($currencyCode)) {
            throw Exceptions::create('format.invalid_currency_code');
        }

        return in_array($currencyCode, $this->_currencies);
    }

    public function getBaseCurrency()
    {
        return (is_null($this->baseCurrency)) ? null : $this->baseCurrency;
    }

    // Get the supported currencies:
    public function getSupportedCurrencies(string $concat = null)
    {
        return (is_null($concat)) ? $this->_currencies : implode($concat, $this->_currencies);
    }
}
