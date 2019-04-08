<?php

namespace Test\Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Source\CentralBankRussianFederation;

class CentralBankRussianFederationTest extends BaseSource
{

    protected function createBankSource($httpClient)
    {
        return new CentralBankRussianFederation($httpClient);
    }

    protected function getBankUrl()
    {
        return 'http://www.cbr.ru/scripts/XML_daily.asp';
    }

    protected function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="windows-1251"?><ValCurs><Valute><CharCode>USD</CharCode><Nominal>1</Nominal><Value>65,4072</Value></Valute><Valute><CharCode>EUR</CharCode><Nominal>1</Nominal>><Value>73,4392</Value></Valute></ValCurs>';
    }

    protected function getExchangeRates()
    {
        return [
            'USD' => [
                'baseCode' => 'RUB',
                'currencyCode' => 'USD',
                'rate' => 0.015384615384615385,
            ],
            'EUR' => [
                'baseCode' => 'RUB',
                'currencyCode' => 'EUR',
                'rate' => 0.0136986301369863,
            ],
            'RUB' => [
                'baseCode' => 'RUB',
                'currencyCode' => 'RUB',
                'rate' => 1.0,
            ],
        ];
    }
}
