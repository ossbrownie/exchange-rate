<?php

namespace Test\Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Source\NationalBankUkraine;

class NationalBankUkraineTest extends BaseSource
{

    protected function createBankSource($httpClient)
    {
        return new NationalBankUkraine($httpClient);
    }

    protected function getBankUrl()
    {
        return 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange';
    }

    protected function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="utf-8"?><exchange><currency><rate>26.768706</rate><cc>USD</cc></currency><currency><rate>30.069287</rate><cc>EUR</cc></currency></exchange>';
    }

    protected function getExchangeRates()
    {
        return [
            'EUR' => [
                'baseCode' => 'UAH',
                'currencyCode' => 'EUR',
                'rate' => 0.033256525171348424,
            ],
            'USD' => [
                'baseCode' => 'UAH',
                'currencyCode' => 'USD',
                'rate' => 0.037357054166159545,
            ],
            'UAH' => [
                'baseCode' => 'UAH',
                'currencyCode' => 'UAH',
                'rate' => 1,
            ],
        ];
    }
}
