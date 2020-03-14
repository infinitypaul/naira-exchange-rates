<?php

namespace Infinitypaul\NairaExchangeRates\Exceptions;

use Exception;

class Exceptions extends Exception
{
    // Error messages:
    /**
     * @var array
     */
    private static $_errors = [
        'format.invalid_date'          => 'The specified date is invalid. Please use ISO 8601 notation (e.g. YYYY-MM-DD).',
        'format.invalid_currency_code' => 'The specified currency code is invalid. Please use ISO 4217 notation (e.g. USD).',
        'format.unsupported_currency'  => 'The specified currency code is not currently supported.',
        'format.unsupported_type'      => 'The Specified Types Is Currently Not Supported',
        'format.is_null'      => 'The Access Token can not be null. Please pass it to the constructor',
    ];

    public static function create($message)
    {
        return new static(self::$_errors[$message]);
    }
}
