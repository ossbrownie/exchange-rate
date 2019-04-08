<?php

namespace Test\Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Source\BankOfIsrael;

class BankOfIsraelTest extends BaseSource
{

    protected function createBankSource($httpClient)
    {
        return new BankOfIsrael($httpClient);
    }

    protected function getBankUrl()
    {
        return 'https://www.boi.org.il/currency.xml';
    }

    protected function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="utf-8" standalone="yes"?><CURRENCIES><CURRENCY><NAME>Dollar</NAME><UNIT>1</UNIT><CURRENCYCODE>USD</CURRENCYCODE><COUNTRY>USA</COUNTRY><RATE>3.587</RATE></CURRENCY><CURRENCY><NAME>Euro</NAME><UNIT>1</UNIT><CURRENCYCODE>EUR</CURRENCYCODE><COUNTRY>EMU</COUNTRY><RATE>4.0276</RATE></CURRENCY></CURRENCIES>';
    }

    protected function getExchangeRates()
    {
        return [
            'USD' => [
                'baseCode' => 'ILS',
                'currencyCode' => 'USD',
                'rate' => 0.2787844995818232,
            ],
            'EUR' => [
                'baseCode' => 'ILS',
                'currencyCode' => 'EUR',
                'rate' => 0.24828682093554477,
            ],
            'ILS' => [
                'baseCode' => 'ILS',
                'currencyCode' => 'ILS',
                'rate' => 1.0,
            ],
        ];
    }
}
