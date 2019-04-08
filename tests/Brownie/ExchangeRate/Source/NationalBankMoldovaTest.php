<?php

namespace Test\Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Source\NationalBankMoldova;

class NationalBankMoldovaTest extends BaseSource
{

    protected function createBankSource($httpClient)
    {
        return new NationalBankMoldova($httpClient);
    }

    protected function getBankUrl()
    {
        return 'https://www.bnm.md/official_exchange_rates?get_xml=1&date=' . date('d.m.Y');
    }

    protected function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="UTF-8"?><ValCurs><Valute><CharCode>USD</CharCode><Nominal>1</Nominal><Value>17.4342</Value></Valute><Valute><CharCode>EUR</CharCode><Nominal>1</Nominal><Value>19.5786</Value></Valute></ValCurs>';
    }

    protected function getExchangeRates()
    {
        return [
            'EUR' => [
                'baseCode' => 'MDL',
                'currencyCode' => 'EUR',
                'rate' => 0.05107617500740604,
            ],
            'USD' => [
                'baseCode' => 'MDL',
                'currencyCode' => 'USD',
                'rate' => 0.05735852519760012,
            ],
            'MDL' => [
                'baseCode' => 'MDL',
                'currencyCode' => 'MDL',
                'rate' => 1,
            ],
        ];
    }
}
