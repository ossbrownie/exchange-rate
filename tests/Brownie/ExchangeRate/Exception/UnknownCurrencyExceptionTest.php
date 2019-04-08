<?php

namespace Test\Brownie\ExchangeRate\Exception;

use Brownie\ExchangeRate\Exception\UnknownCurrencyException;
use PHPUnit\Framework\TestCase;

class UnknownCurrencyExceptionTest extends TestCase
{

    /**
     * @expectedException \Brownie\ExchangeRate\Exception\UnknownCurrencyException
     */
    public function testException()
    {
        throw new UnknownCurrencyException('Test');
    }
}
