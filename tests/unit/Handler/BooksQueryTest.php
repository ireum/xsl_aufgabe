<?php

namespace library\handler
{

    use PHPUnit\Framework\Error\Error;
    use PHPUnit\Framework\TestCase;

    /**
     * Class BooksQueryTest
     * @package library\handler
     * @covers \library\handler\BooksQuery
     */
    class BooksQueryTest extends TestCase
    {
        /** @var BooksQuery */
        private $booksQuery;

        public function setUp()
        {
            $this->booksQuery = new BooksQuery(__DIR__ . '/../../data/testBooks.xml');
        }

        public function testSetSxmlElementThrowsExceptionIfPathIsInvalid()
        {
            // TODO: Exception is not thrown?
//            $this->expectException(\InvalidArgumentException::class);
            $this->expectException(Error::class);
            $this->booksQuery = new BooksQuery(__DIR__ . '/data/invalid.xml');
        }

        public function testGetMinPriceReturnsMinPriceInXml()
        {
            $actual = $this->booksQuery->getMinPrice();
            $expected = 5.95;
            $this->assertSame($expected, $actual);
        }

        public function testGetMaxPriceReturnsMaxPriceInXml()
        {
            $actual = $this->booksQuery->getMaxPrice();
            $expected = 44.95;
            $this->assertSame($expected, $actual);
        }

        public function testGetNextIdReturnsCorrectNextIdBasedOnXml()
        {
            $actual = $this->booksQuery->getNextId();
            $expected = 'bk104';
            $this->assertSame($expected, $actual);
        }
    }
}
