<?php

namespace library\processor;

use library\handler\BookAppender;
use library\handler\ErrorXmlGenerator;
use library\requests\AbstractRequest;
use library\responder\HtmlResponse;
use library\session\Session;
use library\valueobject\Book;
use PHPUnit\Framework\TestCase;

/**
 * Class AddBookProcessorTest
 * @package library\processor
 * @covers library\processor\Processor
 * @covers library\processor\AddBookProcessor
 * @uses library\handler\BookAppender
 * @uses library\handler\ErrorXmlGenerator
 * @uses library\requests\AbstractRequest;
 * @uses library\responder\HtmlResponse;
 * @uses library\session\Session;
 * @uses library\valueobject\Book;
 */
class AddBookProcessorTest extends TestCase
{
    /** @var AddBookProcessor */
    private $addBookProcessor;

    /** @var \PHPUnit_Framework_MockObject_MockObject|BookAppender */
    private $bookAppender;

    /** @var \PHPUnit_Framework_MockObject_MockObject|ErrorXmlGenerator */
    private $errorXmlGenerator;

    /** @var \PHPUnit_Framework_MockObject_MockObject|HtmlResponse */
    private $htmlResponse;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Session */
    private $session;

    public function setUp()
    {
        $this->bookAppender = $this->getMockBuilder(BookAppender::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->errorXmlGenerator = $this->getMockBuilder(ErrorXmlGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->htmlResponse = $this->getMockBuilder(HtmlResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->session = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addBookProcessor = new AddBookProcessor(
            $this->bookAppender,
            $this->errorXmlGenerator,
            $this->session
        );
    }

    public function testExecuteWithvalidBook()
    {
        $book = $this->getMockBuilder(Book::class)
            ->disableOriginalConstructor()
            ->getMock();

        $book->expects($this->once())
            ->method('isValid');

        $this->addBookProcessor->execute($this->htmlResponse, $this->request);
        $this->assertEquals('/add', $this->htmlResponse->getRedirect());

    }
}
