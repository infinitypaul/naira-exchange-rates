<?php

namespace Infinitypaul\NairaExchangeRates;

use Exception;
use GuzzleHttp\Client;
use Infinitypaul\NairaExchangeRates\Exceptions\Exceptions;
use Infinitypaul\NairaExchangeRates\Traits\CurrencyTraits;
use Infinitypaul\NairaExchangeRates\Traits\DateTraits;
use Infinitypaul\NairaExchangeRates\Traits\TypeTraits;

class NairaExchangeRates
{
    use CurrencyTraits, TypeTraits, DateTraits;
    /**
     * Naira Exchange Rate API Base Url.
     */
    const baseURL = 'http://nairaexchangerate.herokuapp.com/api/v1/';

    /**
     * Access token.
     * @var string
     */
    protected $accessToken;

    /**
     *  Response from requests made to Naira Exchange Rate.
     * @var mixed
     */
    protected $response;

    // The type (default is cbn):
    private $type;

    /**
     * Instance of Guzzle Client.
     * @var object
     */
    protected $client;

    // The base currency (default is USD):
    private $baseCurrency;

    // Regular Expression for the currency:
    private $currencyRegExp = '/^[A-Z]{3}$/';

    // Date from which to request historic rates:
    private $dateFrom;

    // Date to which to request historic rates:
    private $dateTo;

    // Supported currencies:
    private $_currencies = [
        'USD', 'GBP', 'EUR', 'JPY', 'XAF', 'CNY', 'QAR', 'ZAR', 'SEK',
    ];

    private $_types = [
        'cbn', 'bdc', 'bank', 'moneygram', 'westernunion',
    ];

    // Regular Expression for the date:
    private $dateRegExp = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';

    public function __construct($accessToken = null)
    {
        if (is_null($accessToken)) {
            throw Exceptions::create('format.is_null');
        }
        $this->accessToken = $accessToken;
        $this->prepareRequest();
    }

    private function prepareRequest()
    {
        $this->client = new Client(['base_uri' => self::baseURL, 'headers' => ['Authorization' => 'Bearer '.$this->accessToken]]);
    }

    public function getResponse()
    {
        return json_decode($this->response->getBody());
    }

    public function performGetRequest($relativeUrl, $params)
    {
        $this->response = $this->client->request('GET', $relativeUrl, $params);

        return $this->getResponse();
    }

    public function fetch()
    {
        // Build the URL:
        $params = [];

        // Set the relevant endpoint:
        $endpoint = (is_null($this->dateFrom)) ? '/latest' : '/history';

        // Add dateFrom if specified:
        if (! is_null($this->getDateFrom())) {
            $params['start_at'] = $this->getDateFrom();
        }

        // Add a dateTo:
        if (! is_null($this->getDateTo())) {
            $params['end_at'] = $this->getDateTo();
        }

        // Set the base currency:
        if (! is_null($this->getBaseCurrency())) {
            $params['currency'] = $this->getBaseCurrency();
        }

        try {
            return  $this->performGetRequest($this->getBaseType().$endpoint, ['query' => $params]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
