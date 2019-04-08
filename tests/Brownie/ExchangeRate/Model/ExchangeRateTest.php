<?php

namespace Test\Brownie\ExchangeRate\Model;

use Brownie\ExchangeRate\Model\ExchangeRate;
use PHPUnit\Framework\TestCase;

class ExchangeRateTest extends TestCase
{

    /**
     * @var ExchangeRate
     */
    private $exchangeRate;

    protected function setUp()
    {
        $this->exchangeRate = new ExchangeRate('CAD', 'USD', 1.5);
    }

    protected function tearDown()
    {
        unset($this->exchangeRate);
    }

    public function testExchangeRate()
    {
        $this->assertEquals('CAD', $this->exchangeRate->getBaseCode());
        $this->assertEquals('USD', $this->exchangeRate->getCurrencyCode());
        $this->assertEquals(1.5, $this->exchangeRate->getRate());
        $this->assertEquals([
            'baseCode' => 'CAD',
            'currencyCode' => 'USD',
            'rate' => 1.5
        ], $this->exchangeRate->toArray());
    }
}
