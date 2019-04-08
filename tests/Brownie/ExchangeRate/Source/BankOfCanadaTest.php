<?php

namespace Test\Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Source\BankOfCanada;

class BankOfCanadaTest extends BaseSource
{

    protected function createBankSource($httpClient)
    {
        return new BankOfCanada($httpClient);
    }

    protected function getBankUrl()
    {
        return 'https://www.bankofcanada.ca/valet/observations/group/FX_RATES_DAILY/xml?recent=1';
    }

    protected function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="UTF-8"?><data><observations><o><v s="FXUSDCAD">1.3386</v><v s="FXEURCAD">1.5020</v></o></observations></data>';
    }

    protected function getExchangeRates()
    {
        return [
            'USD' => [
                'baseCode' => 'CAD',
                'currencyCode' => 'USD',
                'rate' => 0.7470491558344539,
            ],
            'EUR' => [
                'baseCode' => 'CAD',
                'currencyCode' => 'EUR',
                'rate' => 0.6657789613848203,
            ],
            'CAD' => [
                'baseCode' => 'CAD',
                'currencyCode' => 'CAD',
                'rate' => 1.0,
            ],
        ];
    }
}
