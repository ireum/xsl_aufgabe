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
        private $errorFields = ['field1' => 'value1', 'field2' => 'value2'];

        public function setUp()
        {
            $this->invalidBookException = new InvalidBookException('Invalid Book', $this->errorFields);
        }

        public function testGetErrorFieldsReturnsErrorFieldsArrayInsertedByConstructor()
        {
            $actual = $this->invalidBookException->getErrorFields();
            $this->assertEquals($this->errorFields, $actual);
        }
    }
}
