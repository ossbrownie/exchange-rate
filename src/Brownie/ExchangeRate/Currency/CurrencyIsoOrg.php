<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate\Currency;

use Brownie\ExchangeRate\CurrencyInterface;
use Brownie\ExchangeRate\Exception\InvalidExchangeRateException;
use Brownie\ExchangeRate\Model\Currency;
use Brownie\ExchangeRate\Service;
use Brownie\HttpClient\Request;
use Brownie\HttpClient\Exception\ClientException;
use Brownie\HttpClient\Exception\ValidateException;

/**
 * Gets a list of existing currencies.
 */
class CurrencyIsoOrg extends Service implements CurrencyInterface
{

    /**
     * The endpoint access to the list of currencies.
     *
     * @var string
     */
    private $endpoint = 'https://www.currency-iso.org/dam/downloads/lists/list_one.xml';

    /**
     * Returns an array of currencies.
     *
     * @return Currency[]
     *
     * @throws ClientException
     * @throws ValidateException
     * @throws InvalidExchangeRateException
     */
    public function getCurrencies()
    {
        $response = $this
            ->getHttpClient()
            ->request(
                $this
                    ->getHttpClient()
                    ->createRequest()
                    ->setMethod(Request::HTTP_METHOD_GET)
                    ->setUrl($this->endpoint)
            );

        if ((200 != $response->getHttpCode()) || (empty($response->getBody()))) {
            throw new InvalidExchangeRateException('Invalid response from currency exchange server.');
        }

        return $this->buildCurrencies($response->getBody());
    }

    /**
     * Collects currency collection from server response.
     *
     * @param string    $body   Response body content.
     *
     * @return Currency[]
     *
     * @throws InvalidExchangeRateException
     */
    private function buildCurrencies($body)
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($body);

        if (false === $xml) {
            throw new InvalidExchangeRateException('Error parsing the response from the currency exchange server.');
        }

        $currencies = [];
        foreach ($xml->CcyTbl->CcyNtry as $e) {
            $code = (string)$e->Ccy;
            if (!isset($currencies[$code])) {
                $currencies[$code] = new Currency((string)$e->CcyNm, $code, (int)$e->CcyNbr);
            }
        }

        return $currencies;
    }
}
