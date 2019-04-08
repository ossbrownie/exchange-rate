<?php

namespace Test\Brownie\ExchangeRate\Source;

use PHPUnit\Framework\TestCase;
use Brownie\HttpClient\HttpClient;
use Brownie\HttpClient\ResponseInterface;
use Prophecy\Prophecy\MethodProphecy;
use Brownie\HttpClient\Request;
use Brownie\HttpClient\Response;

class BaseSource extends TestCase
{

    private $bankSource;

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
            [$this->getBankUrl()]
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

        $this->bankSource = $this->createBankSource($httpClient->reveal());
    }

    protected function tearDown()
    {
        unset($this->response);
        unset($this->bankSource);
    }

    public function testGetExchangeRates()
    {
        $exchangeRates = $this->getExchangeRates();

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

        $this->assertCount(3, $this->bankSource->getExchangeRates());

        foreach ($this->bankSource->getExchangeRates() as $exchangeRate) {
            $this->assertEquals($exchangeRates[$exchangeRate->getCurrencyCode()], $exchangeRate->toArray());
        }
    }

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\InvalidExchangeRateException
     */
    public function testGetExchangeRatesInvalidExchangeRateExceptionHttpCode()
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

        $this->bankSource->getExchangeRates();
    }

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\InvalidExchangeRateException
     */
    public function testGetExchangeRatesInvalidExchangeRateExceptionResponse()
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

        $this->bankSource->getExchangeRates();
    }
}
