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
        $this->errorException = new ErrorException('ErrorException', 5, 'path', 'line 1');
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

    public function testFileIsFileInsertedByConstructor()
    {
        $actual = $this->errorException->getFile();
        $this->assertSame('path', $actual);
    }

    public function testLineIsLineInsertedByConstructor()
    {
        $actual = $this->errorException->getLine();
        $this->assertSame('line 1', $actual);
    }
}
