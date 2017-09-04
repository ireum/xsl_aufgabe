<?php

namespace library\handler;

use library\backends\FileBackend;
use library\exceptions\ErrorException;
use library\valueobject\Book;
use PHPUnit\Framework\TestCase;

/**
 * Class BookAppenderTest
 * @package library\handler
 * @covers \library\handler\BookAppender
 * @uses   \library\handler\BooksQuery
 * @uses   \library\valueobject\Book
 * @uses \library\exceptions\ErrorException
 * @uses \library\backends\FileBackend
 */
class BookAppenderTest extends TestCase
{
    /** @var BookAppender */
    private $bookAppender;

    /** @var \PHPUnit_Framework_MockObject_MockObject|BooksQuery */
    private $booksQuery;

    /** @var \PHPUnit_Framework_MockObject_MockObject|FileBackend */
    private $fileBackend;

    public function setUp()
    {
        //TODO: Test anpassen mit FileBackend
        $this->booksQuery = $this->getMockBuilder(BooksQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fileBackend = $this->getMockBuilder(FileBackend::class)
            ->disableOriginalConstructor()
            ->getMock();

        $path = __DIR__ . '/../../data/testBooks.xml';
        $this->bookAppender = new BookAppender($path, $this->booksQuery, $this->fileBackend);
    }
    public function testSetSxmlElementThrowsExceptionIfPathIsInvalid()
    {
        $this->expectException(ErrorException::class);
        $path = __DIR__ . '/../../data/testError.xml';
        $this->bookAppender = new BookAppender($path, $this->booksQuery, $this->fileBackend);
    }

    public function testAddBookAddsBook()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|Book $book */
        $book = $this->getMockBuilder(Book::class)->disableOriginalConstructor()->getMock();

        $this->booksQuery->expects($this->once())->method('getNextId')->willReturn('bk104');

        //TODO: Sämtliche Expectations auf $book fehlen
        //TODO: FileBackEnd returns FALSE?
//        var_dump($this->bookAppender->addBook($book));exit('hitme');

        $this->bookAppender->addBook($book);
//        $testXml = __DIR__ . '/../../data/testBooks.xml';
//        $dom = new \DOMDocument();
//        $dom->load($testXml);
//        $xpath = new \DOMXPath($dom);

//        /** @var \DOMElement $testNode */
//        $testNode = $xpath->query('//catalog/book[last()]')[0];
//        $actual = $testNode->getAttribute('id');
//        $this->assertSame('bk104', $actual);
//        $testNode->parentNode->removeChild($testNode);
//        $dom->save($testXml);
    }
}
