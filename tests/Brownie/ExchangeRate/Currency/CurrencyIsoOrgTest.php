<?php

namespace Test\Brownie\ExchangeRate\Currency;

use Brownie\ExchangeRate\Currency\CurrencyIsoOrg;
use Brownie\HttpClient\HttpClient;
use Brownie\HttpClient\Request;
use Brownie\HttpClient\Response;
use Brownie\HttpClient\ResponseInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;

class CurrencyIsoOrgTest extends TestCase
{

    /**
     * @var CurrencyIsoOrg
     */
    private $currency;

    private $response;

    protected function setUp()
    {
        $request = $this->prophesize(Request::class);

        $requestMethodSetMethod = new MethodProphecy(
            $request,
            'setMethod',
            ['GET']
        );

        $requestMethodSetUrl = new MethodProphecy(
            $request,
            'setUrl',
            ['https://www.currency-iso.org/dam/downloads/lists/list_one.xml']
        );

        $request
            ->addMethodProphecy(
                $requestMethodSetMethod->willReturn($request)
            );

        $request
            ->addMethodProphecy(
                $requestMethodSetUrl->willReturn($request)
            );

        $this->response = $this->prophesize(Response::class);
        $this->response->willImplement(ResponseInterface::class);

        $httpClient = $this->prophesize(HttpClient::class);

        $httpClientMethodCreateRequest = new MethodProphecy(
            $httpClient,
            'createRequest',
            []
        );

        $httpClientMethodRequest = new MethodProphecy(
            $httpClient,
            'request',
            [$request]
        );

        $httpClient
            ->addMethodProphecy(
                $httpClientMethodCreateRequest->willReturn($request)
            );

        $httpClient
            ->addMethodProphecy(
                $httpClientMethodRequest->willReturn($this->response)
            );

        $this->currency = new CurrencyIsoOrg($httpClient->reveal());
    }

    protected function tearDown()
    {
        unset($this->currency);
        unset($this->response);
    }

    public function testGetCurrencies()
    {
        $responseMethodGetHttpCode = new MethodProphecy(
            $this->response,
            'getHttpCode',
            []
        );

        $responseMethodGetBody = new MethodProphecy(
            $this->response,
            'getBody',
            []
        );

        $this->response
            ->addMethodProphecy(
                $responseMethodGetHttpCode->willReturn(200)
            );

        $this->response
            ->addMethodProphecy(
                $responseMethodGetBody->willReturn($this->getSuccessfulBodyResponse())
            );

        $currencies = [
            'USD' => [
                'currency' => 'US Dollar',
                'code' => 'USD',
                'num' => 840,
            ],
            'EUR' => [
                'currency' => 'Euro',
                'code' => 'EUR',
                'num' => 978,
            ],
            'CAD' => [
                'currency' => 'Canadian Dollar',
                'code' => 'CAD',
                'num' => 124,
            ],
        ];
        foreach ($this->currency->getCurrencies() as $currency) {
            $this->assertEquals($currencies[$currency->getCode()], $currency->toArray());
        }
    }

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\InvalidExchangeRateException
     */
    public function testGetCurrenciesInvalidExchangeRateExceptionHttpCode()
    {
        $responseMethodGetHttpCode = new MethodProphecy(
            $this->response,
            'getHttpCode',
            []
        );

        $responseMethodGetBody = new MethodProphecy(
            $this->response,
            'getBody',
            []
        );

        $this->response
            ->addMethodProphecy(
                $responseMethodGetHttpCode->willReturn(404)
            );

        $this->response
            ->addMethodProphecy(
                $responseMethodGetBody->willReturn($this->getSuccessfulBodyResponse())
            );

        $this->currency->getCurrencies();
    }

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\InvalidExchangeRateException
     */
    public function testGetCurrenciesInvalidExchangeRateExceptionResponse()
    {
        $responseMethodGetHttpCode = new MethodProphecy(
            $this->response,
            'getHttpCode',
            []
        );

        $responseMethodGetBody = new MethodProphecy(
            $this->response,
            'getBody',
            []
        );

        $this->response
            ->addMethodProphecy(
                $responseMethodGetHttpCode->willReturn(200)
            );

        $this->response
            ->addMethodProphecy(
                $responseMethodGetBody->willReturn('<?xml version="1.0" encoding="UTF-8"?>')
            );

        $this->currency->getCurrencies();
    }

    private function getSuccessfulBodyResponse()
    {
        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><ISO_4217 Pblshd="2018-08-29"><CcyTbl><CcyNtry><CcyNm>US Dollar</CcyNm><Ccy>USD</Ccy><CcyNbr>840</CcyNbr></CcyNtry><CcyNtry><CcyNm>Euro</CcyNm><Ccy>EUR</Ccy><CcyNbr>978</CcyNbr></CcyNtry><CcyNtry><CcyNm>Canadian Dollar</CcyNm><Ccy>CAD</Ccy><CcyNbr>124</CcyNbr></CcyNtry></CcyTbl></ISO_4217>';
    }
}
