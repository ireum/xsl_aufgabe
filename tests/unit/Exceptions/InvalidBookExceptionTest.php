<?php

namespace library\exceptions
{

    use PHPUnit\Framework\TestCase;

    /**
     * Class InvalidBookExceptionTest
     * @package library\exceptions
     * @covers library\exceptions\InvalidBookException
     */
    class InvalidBookExceptionTest extends TestCase
    {
        /** @var InvalidBookException */
        private $invalidBookException;

        public function setUp()
        {
            $errorFields = ['field1' => 'value1', 'field2' => 'value2'];
            $this->invalidBookException = new InvalidBookException('Invalid Book', $errorFields);
        }

        public function testGetErrorFieldsReturnsErrorFieldsArrayInsertedByConstructor()
        {
            $expected = ['field1' => 'value1', 'field2' => 'value2'];
            $actual = $this->invalidBookException->getErrorFields();
            $this->assertEquals($expected, $actual);
        }
    }
}
