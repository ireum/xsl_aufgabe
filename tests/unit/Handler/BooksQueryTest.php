<?php

namespace library\handler
{

    use library\backends\FileBackend;
    use library\exceptions\ErrorException;
    use PHPUnit\Framework\Error\Error;
    use PHPUnit\Framework\TestCase;

    /**
     * Class BooksQueryTest
     * @package library\handler
     * @covers \library\handler\BooksQuery
     * @uses \library\exceptions\ErrorException
     * @uses \library\backends\FileBackend
     */
    class BooksQueryTest extends TestCase
    {
        /** @var BooksQuery */
        private $booksQuery;

        /** @var \PHPUnit_Framework_MockObject_MockObject|FileBackend */
        private $fileBackend;

        public function setUp()
        {
            $this->fileBackend = $this->getMockBuilder(FileBackend::class)
                ->disableOriginalConstructor()
                ->getMock();

            $path = __DIR__ . '/../../data/testBooks.xml';
            $this->fileBackend->expects($this->once())
                ->method('load')
                ->with($path)
                ->willReturn(file_get_contents($path));

            $this->booksQuery = new BooksQuery($path, $this->fileBackend);
        }

        public function testSetSxmlElementThrowsExceptionIfPathIsInvalid()
        {
            $this->expectException(ErrorException::class);
            $this->booksQuery = new BooksQuery(__DIR__ . '/data/invalid.xml', $this->fileBackend);
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
