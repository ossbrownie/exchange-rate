<?php

namespace Test\Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Source\EuropeanCentralBank;

class EuropeanCentralBankTest extends BaseSource
{

    protected function createBankSource($httpClient)
    {
        return new EuropeanCentralBank($httpClient);
    }

    protected function getBankUrl()
    {
        return 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
    }

    protected function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="UTF-8"?><gesmes:Envelope><Cube><Cube><Cube currency=\'CAD\' rate=\'1.5030\'/><Cube currency=\'USD\' rate=\'1.1233\'/></Cube></Cube></gesmes:Envelope>';
    }

    protected function getExchangeRates()
    {
        return [
            'CAD' => [
                'baseCode' => 'EUR',
                'currencyCode' => 'CAD',
                'rate' => 1.503,
            ],
            'USD' => [
                'baseCode' => 'EUR',
                'currencyCode' => 'USD',
                'rate' => 1.1233,
            ],
            'EUR' => [
                'baseCode' => 'EUR',
                'currencyCode' => 'EUR',
                'rate' => 1.0,
            ],
        ];
    }
}
