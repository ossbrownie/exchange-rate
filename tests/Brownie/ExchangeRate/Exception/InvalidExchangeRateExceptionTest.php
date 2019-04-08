<?php

namespace Test\Brownie\ExchangeRate\Exception;

use Brownie\ExchangeRate\Exception\InvalidExchangeRateException;
use PHPUnit\Framework\TestCase;

class InvalidExchangeRateExceptionTest extends TestCase
{

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\InvalidExchangeRateException
     */
    public function testException()
    {
        throw new InvalidExchangeRateException('Test');
    }
}
