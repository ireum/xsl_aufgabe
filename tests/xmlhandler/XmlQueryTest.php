<?php

namespace library\handler
{

    use PHPUnit\Framework\Error\Error;
    use PHPUnit\Framework\TestCase;

    class XmlQueryTest extends TestCase
    {
        /** @var BooksQuery */
        private $xmlQuery;

        public function setUp()
        {
            $this->xmlQuery = new BooksQuery(__DIR__ . '/data/test.xml');
        }

        public function testSetSxmlElementThrowsExceptionIfPathIsInvalid()
        {
            // TODO: Exception is not thrown?
//            $this->expectException(\InvalidArgumentException::class);
            $this->expectException(Error::class);
            $this->xmlQuery = new BooksQuery(__DIR__ . '/data/invalid.xml');
        }

        public function testGetMinPriceReturnsMinPriceInXml()
        {
            $actual = $this->xmlQuery->getMinPrice();
            $expected = 10.10;
            $this->assertSame($expected, $actual);
        }

        public function testGetMaxPriceReturnsMaxPriceInXml()
        {
            $actual = $this->xmlQuery->getMaxPrice();
            $expected = 20.20;
            $this->assertSame($expected, $actual);
        }

        public function testGetNextIdReturnsCorrectNextIdBasedOnXml()
        {
            $actual = $this->xmlQuery->getNextId();
            $expected = 'bk103';
            $this->assertSame($expected, $actual);
        }
    }
}
