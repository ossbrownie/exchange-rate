<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate\Model;

/**
 * A currency model.
 */
class Currency
{

    /**
     * Currency name.
     *
     * @var string
     */
    private $currency;

    /**
     * Currency code.
     *
     * @var string
     */
    private $code;

    /**
     * Currency number.
     *
     * @var int
     */
    private $num;

    /**
     * Sets the input values.
     *
     * @param string    $currency   Currency name.
     * @param string    $code       Currency code.
     * @param int       $num        Currency number.
     */
    public function __construct($currency, $code, $num)
    {
        $this
            ->setCurrency($currency)
            ->setCode($code)
            ->setNum($num);
    }

    /**
     * Sets currency name.
     * Returns the current object.
     *
     * @param string    $currency   Currency name.
     *
     * @return self
     */
    private function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Sets currency code.
     * Returns the current object.
     *
     * @param string    $code   Currency code.
     *
     * @return self
     */
    private function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Sets currency number.
     * Returns the current object.
     *
     * @param int   $num    Currency number.
     *
     * @return self
     */
    private function setNum($num)
    {
        $this->num = $num;
        return $this;
    }

    /**
     * Gets currency name.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Gets currency code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Gets currency number.
     *
     * @return int
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Gets currency data as an associative array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'currency' => $this->getCurrency(),
            'code' => $this->getCode(),
            'num' => $this->getNum(),
        ];
    }
}
