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

    /** @var \PHPUnit_Framework_MockObject_MockObject|Book */
    private $book;

    /** @var string */
    private $path;

    public function setUp()
    {
        $this->booksQuery = $this->getMockBuilder(BooksQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fileBackend = $this->getMockBuilder(FileBackend::class)
            ->getMock();

        $this->book = $this->getMockBuilder(Book::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->path = __DIR__ . '/../../data/testBooks.xml';
        $this->fileBackend->expects($this->once())
            ->method('load')
            ->with($this->path)
            ->willReturn(file_get_contents($this->path));

        $this->bookAppender = new BookAppender($this->path, $this->booksQuery, $this->fileBackend);

    }

    public function testSetSxmlElementThrowsExceptionIfPathIsInvalid()
    {
        $this->expectException(ErrorException::class);
        $path = __DIR__ . '/../../data/testError.xml';
        $this->bookAppender = new BookAppender($path, $this->booksQuery, $this->fileBackend);
    }


    public function bookMethodProvider()
    {
        return array(
            array('getAuthor'),
            array('getTitle'),
            array('getGenre'),
            array('getPrice'),
            array('getReleaseDate'),
            array('getDescription'),
        );
    }

    /**
     * @dataProvider bookMethodProvider
     */
    public function testAddBookAddsBook($methodToCall)
    {
        $this->booksQuery->expects($this->once())
            ->method('getNextId')
            ->willReturn('bk104');

        $this->book->expects($this->once())
            ->method($methodToCall);

        $this->fileBackend->expects($this->once())
            ->method('save')
            ->with($this->path);

        $this->bookAppender->addBook($this->book);
    }
}
