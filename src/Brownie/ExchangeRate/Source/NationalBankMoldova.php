<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate\Source;

use Brownie\ExchangeRate\Service;
use Brownie\ExchangeRate\SourceInterface;
use Brownie\HttpClient\Request;
use Brownie\ExchangeRate\Model\ExchangeRate;
use Brownie\HttpClient\Exception\ClientException;
use Brownie\HttpClient\Exception\ValidateException;
use Brownie\ExchangeRate\Exception\InvalidExchangeRateException;

class NationalBankMoldova extends Service implements SourceInterface
{

    /**
     * Base currency.
     *
     * @var string
     */
    protected $baseCode = 'MDL';

    /**
     * The endpoint access to the list of exchange rate.
     *
     * @var string
     */
    private $endpoint = 'https://www.bnm.md/official_exchange_rates?get_xml=1&date=%s';

    /**
     * Returns the current exchange rate.
     *
     * @return ExchangeRate[]
     *
     * @throws ClientException
     * @throws ValidateException
     * @throws InvalidExchangeRateException
     */
    public function getExchangeRates()
    {
        $response = $this
            ->getHttpClient()
            ->request(
                $this
                    ->getHttpClient()
                    ->createRequest()
                    ->setMethod(Request::HTTP_METHOD_GET)
                    ->setUrl(sprintf($this->endpoint, date('d.m.Y')))
            );

        if ((200 != $response->getHttpCode()) || (empty($response->getBody()))) {
            throw new InvalidExchangeRateException('Invalid response from currency exchange server.');
        }

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response->getBody());

        if (false === $xml) {
            throw new InvalidExchangeRateException('Error parsing the response from the currency exchange server.');
        }

        $exchangeRates = [];
        foreach ($xml->Valute as $e) {
            $currencyCode = (string)$e->CharCode;
            $exchangeRates[$currencyCode] = new ExchangeRate(
                $this->getBaseCode(),
                $currencyCode,
                1 / ((float)$e->Value / (int)$e->Nominal)
            );
        }

        $exchangeRates[$this->getBaseCode()] = new ExchangeRate(
            $this->getBaseCode(),
            $this->getBaseCode(),
            1.0
        );

        return $exchangeRates;
    }
}
