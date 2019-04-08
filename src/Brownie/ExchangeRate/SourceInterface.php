<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate;

use Brownie\ExchangeRate\Model\ExchangeRate as ExchangeRateCollection;

interface SourceInterface
{

    /**
     * Returns the current exchange rate.
     *
     * @return ExchangeRateCollection[]
     */
    public function getExchangeRates();
}
