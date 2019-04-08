<?php

namespace Test\Brownie\ExchangeRate;

use Brownie\ExchangeRate\CurrencyInterface;
use Brownie\ExchangeRate\ExchangeRate;
use Brownie\ExchangeRate\SourceInterface;
use PHPUnit\Framework\TestCase;
use Brownie\ExchangeRate\Model\Currency;
use Brownie\ExchangeRate\Model\ExchangeRate as ModelExchangeRate;
use Prophecy\Prophecy\MethodProphecy;

class ExchangeRateTest extends TestCase
{

    /**
     * @var ExchangeRate
     */
    private $exchangeRate;

    private $currencies;

    private $exchangeRates;

    protected function setUp()
    {
        $currencyUSD = $this->prophesize(Currency::class);
        $currencyEUR = $this->prophesize(Currency::class);
        $currencyCAD = $this->prophesize(Currency::class);
        $this->currencies = [
            'USD' => $currencyUSD->reveal(),
            'EUR' => $currencyEUR->reveal(),
            'CAD' => $currencyCAD->reveal(),
        ];

        $exchangeRateUSD = $this->prophesize(ModelExchangeRate::class);
        $exchangeRateUSDMethodGetRate = new MethodProphecy(
            $exchangeRateUSD,
            'getRate',
            []
        );
        $exchangeRateUSD
            ->addMethodProphecy(
                $exchangeRateUSDMethodGetRate->willReturn(1.5)
            );

        $exchangeRateEUR = $this->prophesize(ModelExchangeRate::class);
        $exchangeRateEURMethodGetRate = new MethodProphecy(
            $exchangeRateEUR,
            'getRate',
            []
        );
        $exchangeRateEUR
            ->addMethodProphecy(
                $exchangeRateEURMethodGetRate->willReturn(2.5)
            );

        $exchangeRateCAD = $this->prophesize(ModelExchangeRate::class);
        $exchangeRateCADMethodGetRate = new MethodProphecy(
            $exchangeRateCAD,
            'getRate',
            []
        );
        $exchangeRateCAD
            ->addMethodProphecy(
                $exchangeRateCADMethodGetRate->willReturn(3.5)
            );

        $this->exchangeRates = [
            'USD' => $exchangeRateUSD->reveal(),
            'EUR' => $exchangeRateEUR->reveal(),
            'CAD' => $exchangeRateCAD->reveal()
        ];

        $currencyInterface = $this->prophesize(CurrencyInterface::class);
        $currencyInterfaceMethodGetCurrencies = new MethodProphecy(
            $currencyInterface,
            'getCurrencies',
            []
        );
        $currencyInterface
            ->addMethodProphecy(
                $currencyInterfaceMethodGetCurrencies->willReturn($this->currencies)
            );

        $sourceInterface = $this->prophesize(SourceInterface::class);
        $currencyInterfaceMethodGetExchangeRates = new MethodProphecy(
            $sourceInterface,
            'getExchangeRates',
            []
        );
        $sourceInterface
            ->addMethodProphecy(
                $currencyInterfaceMethodGetExchangeRates->willReturn($this->exchangeRates)
            );

        $this->exchangeRate = new ExchangeRate(
            $currencyInterface->reveal(),
            $sourceInterface->reveal()
        );
    }

    protected function tearDown()
    {
        $this->exchangeRate = null;
    }

    public function testGetCurrencies()
    {
        $this->assertEquals($this->currencies, $this->exchangeRate->getCurrencies());
    }

    public function testSetGetCurrencies()
    {
        $currencyUSD = $this->prophesize(Currency::class);
        $currencies = [
            $currencyUSD->reveal(),
        ];
        $this->assertInstanceOf(ExchangeRate::class, $this->exchangeRate->setCurrencies($currencies));
        $this->assertEquals($currencies, $this->exchangeRate->getCurrencies());
    }

    public function testGetExchangeRates()
    {
        $this->assertEquals($this->exchangeRates, $this->exchangeRate->getExchangeRates());
    }

    public function testSetGetExchangeRates()
    {
        $exchangeRateEUR = $this->prophesize(ModelExchangeRate::class);
        $exchangeRates = [
            $exchangeRateEUR->reveal(),
        ];
        $this->assertInstanceOf(ExchangeRate::class, $this->exchangeRate->setExchangeRates($exchangeRates));
        $this->assertEquals($exchangeRates, $this->exchangeRate->getExchangeRates());
    }

    public function testConvert()
    {
        $this->assertEquals(205.0, $this->exchangeRate->converter(123, 'USD', 'EUR'));
        $this->assertEquals(638.4, $this->exchangeRate->converter(456, 'EUR', 'CAD'));
    }

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\UnknownCurrencyException
     */
    public function testConvertUnknownCurrencyException()
    {
        $this->assertEquals(205.0, $this->exchangeRate->converter(123, 'USD', 'SEK'));
    }
}
