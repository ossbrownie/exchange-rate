<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate;

use Brownie\ExchangeRate\Model\Currency;

interface CurrencyInterface
{

    /**
     * Returns an array of currencies.
     *
     * @return Currency[]
     */
    public function getCurrencies();
}
