<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate;

use Brownie\ExchangeRate\Exception\UnknownCurrencyException;
use Brownie\ExchangeRate\Model\Currency as ModelCurrency;
use Brownie\ExchangeRate\Model\ExchangeRate as ModelExchangeRate;

/**
 * Service for currency rates.
 */
class ExchangeRate
{

    /**
     * Service to get current currency list.
     *
     * @var CurrencyInterface
     */
    private $currencyService;

    /**
     * Service to get current exchange rates.
     *
     * @var SourceInterface
     */
    private $sourceService;

    /**
     * List of currencies.
     *
     * @var ModelCurrency[]
     */
    private $currencies;

    /**
     * List of currency exchange rates to convert.
     *
     * @var ModelExchangeRate[]
     */
    private $exchangeRates;

    /**
     * Sets the input values.
     *
     * @param CurrencyInterface     $currencyService    Service to get current currency list.
     * @param SourceInterface       $sourceService      Service to get current exchange rates.
     */
    public function __construct(
        CurrencyInterface $currencyService,
        SourceInterface $sourceService
    ) {
        $this
            ->setCurrencyService($currencyService)
            ->setSourceService($sourceService);
    }

    /**
     * Sets service to get current currency list.
     * Returns the current object.
     *
     * @param CurrencyInterface     $currencyService    Sets service to get current currency list.
     *
     * @return self
     */
    private function setCurrencyService(CurrencyInterface $currencyService)
    {
        $this->currencyService = $currencyService;
        return $this;
    }

    /**
     * Sets service to get current exchange rates.
     * Returns the current object.
     *
     * @param SourceInterface   $sourceService  Service to get current exchange rates.
     *
     * @return self
     */
    private function setSourceService(SourceInterface $sourceService)
    {
        $this->sourceService = $sourceService;
        return $this;
    }

    /**
     * Gets service to get current currency list.
     *
     * @return CurrencyInterface
     */
    private function getCurrencyService()
    {
        return $this->currencyService;
    }

    /**
     * Gets service to get current exchange rates.
     *
     * @return SourceInterface
     */
    private function getSourceService()
    {
        return $this->sourceService;
    }

    /**
     * Sets an array of currencies.
     * Returns the current object.
     *
     * @param ModelCurrency[]   $currencies     Array of currencies.
     *
     * @return self
     */
    public function setCurrencies(array $currencies)
    {
        $this->currencies = $currencies;
        return $this;
    }

    /**
     * Gets an array of currencies.
     *
     * @return ModelCurrency[]
     */
    public function getCurrencies()
    {
        if (empty($this->currencies)) {
            $this->setCurrencies($this->getCurrencyService()->getCurrencies());
        }
        return $this->currencies;
    }

    /**
     * Sets the current list of currency exchange.
     * Returns the current object.
     *
     * @param ModelExchangeRate[]   $exchangeRates  Current list of currency exchange.
     *
     * @return self
     */
    public function setExchangeRates(array $exchangeRates)
    {
        $this->exchangeRates = $exchangeRates;
        return $this;
    }

    /**
     * Gets the current list of currency exchange.
     *
     * @return ModelExchangeRate[]
     */
    public function getExchangeRates()
    {
        if (empty($this->exchangeRates)) {
            $this->setExchangeRates($this->getSourceService()->getExchangeRates());
        }
        return $this->exchangeRates;
    }

    /**
     * Converts an amount from one currency to another.
     *
     * @param float     $amount
     * @param string    $from
     * @param string    $to
     * @param int       $precision
     *
     * @return float
     *
     * @throws UnknownCurrencyException
     */
    public function converter($amount, $from, $to, $precision = 2)
    {
        $exchangeRates = $this->getExchangeRates();

        if (!isset($exchangeRates[$from]) || !isset($exchangeRates[$to])) {
            throw new UnknownCurrencyException('Unknown currency covert: ' . $from . ' / ' . $to);
        }

        return round($amount / $exchangeRates[$from]->getRate() * $exchangeRates[$to]->getRate(), $precision);
    }
}
