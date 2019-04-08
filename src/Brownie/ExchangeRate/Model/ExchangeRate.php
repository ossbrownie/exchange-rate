<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate\Model;

/**
 * A exchange rate model.
 */
class ExchangeRate
{

    /**
     * Base currency.
     *
     * @var string
     */
    private $baseCode;

    /**
     * Currency code.
     *
     * @var string
     */
    private $currencyCode;

    /**
     * Currency rate.
     * Indicates how much the base currency is in the current one.
     *
     * @var float
     */
    private $rate;

    /**
     * Sets the input values.
     *
     * @param string    $baseCode       Base currency.
     * @param string    $currencyCode   Currency code.
     * @param float     $rate           Currency rate.
     */
    public function __construct($baseCode, $currencyCode, $rate)
    {
        $this
            ->setBaseCode($baseCode)
            ->setCurrencyCode($currencyCode)
            ->setRate($rate);
    }

    /**
     * Sets base currency.
     * Returns the current object.
     *
     * @param string    $baseCode   Base currency.
     *
     * @return self
     */
    private function setBaseCode($baseCode)
    {
        $this->baseCode = $baseCode;
        return $this;
    }

    /**
     * Sets currency code.
     * Returns the current object.
     *
     * @param string    $currencyCode   Currency code.
     *
     * @return self
     */
    private function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    /**
     * Sets currency rate.
     * Returns the current object.
     *
     * @param float     $rate   Currency rate.
     *
     * @return self
     */
    private function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * Gets base currency.
     *
     * @return string
     */
    public function getBaseCode()
    {
        return $this->baseCode;
    }

    /**
     * Gets currency code.
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Gets currency rate.
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Gets currency exchange data as an associative array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'baseCode' => $this->getBaseCode(),
            'currencyCode' => $this->getCurrencyCode(),
            'rate' => $this->getRate()
        ];
    }
}
