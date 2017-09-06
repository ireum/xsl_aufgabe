<?php

namespace library\processor;

use library\exceptions\InvalidBookException;
use library\factories\Factory;
use library\handler\BookAppender;
use library\handler\ErrorXmlGenerator;
use library\requests\AbstractRequest;
use library\requests\PostRequest;
use library\responder\HtmlResponse;
use library\session\Session;
use library\valueobject\Book;
use PHPUnit\Framework\TestCase;

/**
 * Class AddBookProcessorTest
 * @package \library\processor
 * @covers \library\processor\AddBookProcessor
 * @uses \library\handler\BookAppender
 * @uses \library\handler\ErrorXmlGenerator
 * @uses \library\requests\AbstractRequest
 * @uses \library\responder\HtmlResponse
 * @uses \library\session\Session
 * @uses \library\valueobject\Book
 * @uses \library\exceptions\InvalidBookException
 */
class AddBookProcessorTest extends TestCase
{
    /** @var AddBookProcessor */
    private $addBookProcessor;

    /** @var \PHPUnit_Framework_MockObject_MockObject|BookAppender */
    private $bookAppender;

    /** @var \PHPUnit_Framework_MockObject_MockObject|ErrorXmlGenerator */
    private $errorXmlGenerator;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Session */
    private $session;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Factory */
    private $factory;

    /** @var \PHPUnit_Framework_MockObject_MockObject|HtmlResponse */
    private $response;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;

    //TODO: X Boooooh! Warum kein Mock?
    public function setUp()
    {
        $this->bookAppender = $this->getMockBuilder(BookAppender::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->errorXmlGenerator = $this->getMockBuilder(ErrorXmlGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->session = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->response = $this->getMockBuilder(HtmlResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addBookProcessor = new AddBookProcessor(
            $this->bookAppender,
            $this->errorXmlGenerator,
            $this->session,
            $this->factory
        );
    }

    public function testExecuteWithValidBook()
    {

//        $this->request->expects($this->exactly(13))
//            ->method('get')
//            ->will(
//                $this->returnValueMap(
//                    array(
//                        array('author', 'Agus'),
//                        array('title', 'UE4'),
//                        array('genre', 'Computer'),
//                        array('price', 5.5),
//                        array('releaseDate', '1990-01-01'),
//                        array('description', 'UE4 Basics')
//                    )
//                )
//            );
//
//        $this->request
//            ->expects($this->any())
//            ->method('has')
//            ->willReturn(true);

        $request = new PostRequest(
            [
                'author' => 'Agus',
                'title' => 'UE4',
                'genre' => 'Computer',
                'price' => 5.5,
                'releaseDate' => '1990-01-01',
                'description' => 'UE4 Basics'
            ],
            []
        );

        $this->bookAppender->expects($this->once())
            ->method('addBook');

        $this->response->expects($this->once())
            ->method('setRedirect')
            ->with('/library');

        $this->addBookProcessor->execute($this->response, $request);
    }

    public function testExecuteWithInvalidBook()
    {
        $request = new PostRequest(
            [
                'author' => 'Agus',
                'title' => 'UE4',
                'genre' => 'Computer',
                'price' => -5.5,
                'releaseDate' => '1990-01-01',
                'description' => 'UE4 Basics'
            ],
            []
        );

        $this->response->expects($this->once())
            ->method('setRedirect')
            ->with('/add');
        $this->addBookProcessor->execute($this->response, $request);
    }
}
