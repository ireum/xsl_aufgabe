<?php

namespace library\exceptions;

use PHPUnit\Framework\TestCase;

/**
 * @covers \library\exceptions\ErrorException
 */
class ErrorExceptionTest extends TestCase
{
    /** @var ErrorException */
    private $errorException;

    public function setUp()
    {
        $this->errorException = new ErrorException('ErrorException', 5);
    }

    public function testMessageIsMessageInsertedByConstructor()
    {
        $actual = $this->errorException->getMessage();
        $this->assertSame('ErrorException', $actual);
    }

    public function testGetSeverityIsSeverityInsertedByConstructor()
    {
        $actual = $this->errorException->getSeverity();
        $this->assertSame(5, $actual);
    }
}
