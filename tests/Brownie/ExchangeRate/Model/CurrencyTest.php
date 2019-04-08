<?php

namespace Test\Brownie\ExchangeRate\Model;

use Brownie\ExchangeRate\Model\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{

    /**
     * @var Currency
     */
    private $currency;

    protected function setUp()
    {
        $this->currency = new Currency('Dollar', 'USD', 840);
    }

    protected function tearDown()
    {
        unset($this->currency);
    }

    public function testCurrency()
    {
        $this->assertEquals('Dollar', $this->currency->getCurrency());
        $this->assertEquals('USD', $this->currency->getCode());
        $this->assertEquals(840, $this->currency->getNum());
        $this->assertEquals([
            'currency' => 'Dollar',
            'code' => 'USD',
            'num' => 840
        ], $this->currency->toArray());
    }
}
