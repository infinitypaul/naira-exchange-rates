<?php

namespace Infinitypaul\NairaExchangeRates\Traits;

use Infinitypaul\NairaExchangeRates\Exceptions\Exceptions;

trait DateTraits
{
    // Regular Expression for the date:
    private $dateRegExp = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

    // Date from which to request historic rates:
    private $dateFrom;

    // Date to which to request historic rates:
    private $dateTo;

    // Get the "from" date:
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    // Get the "to" date:
    public function getDateTo()
    {
        return $this->dateTo;
    }

    // Add a date-from:
    public function addDateFrom(string $from)
    {
        if ($this->validateDateFormat($from)) {
            $this->dateFrom = $from;

            // Return object to preserve method-chaining:
            return $this;
        }

        throw Exceptions::create('format.invalid_date');
    }

    // Add a date-to:
    public function addDateTo(string $to)
    {
        if ($this->validateDateFormat($to)) {
            $this->dateTo = $to;

            // Return object to preserve method-chaining:
            return $this;
        }

        throw Exceptions::create('format.invalid_date');
    }

    // Validate a date is in the correct format:
    private function validateDateFormat(string $date = null)
    {
        if (! is_null($date)) {
            return preg_match($this->dateRegExp, $date);
        }

        return false;
    }
}
