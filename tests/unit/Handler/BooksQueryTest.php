<?php

namespace library\handler
{

    use library\exceptions\ErrorException;
    use PHPUnit\Framework\Error\Error;
    use PHPUnit\Framework\TestCase;

    /**
     * Class BooksQueryTest
     * @package library\handler
     * @covers \library\handler\BooksQuery
     * @uses \library\exceptions\ErrorException
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
            $this->expectException(ErrorException::class);
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
