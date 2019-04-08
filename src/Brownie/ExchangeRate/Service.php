<?php
/**
 * @category    Brownie/ExchangeRate
 * @author      Brownie <oss.brownie@gmail.com>
 * @license     https://opensource.org/licenses/MIT
 */

namespace Brownie\ExchangeRate;

use Brownie\HttpClient\HttpClient;

/**
 * Base class for services.
 */
class Service
{

    /**
     * Base currency.
     *
     * @var string
     */
    protected $baseCode = 'USD';

    /**
     * HTTP client.
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Sets the input values.
     *
     * @param HttpClient    $httpClient     HTTP client.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->setHttpClient($httpClient);
    }

    /**
     * Sets HTTP client.
     * Returns the current object.
     *
     * @param HttpClient    $httpClient     HTTP client.
     *
     * @return self
     */
    private function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * Gets HTTP client.
     *
     * @return HttpClient
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Gets base currency.
     *
     * @return string
     */
    protected function getBaseCode()
    {
        return $this->baseCode;
    }
}
