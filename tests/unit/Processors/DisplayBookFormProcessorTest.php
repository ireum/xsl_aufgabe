<?php

namespace library\processor;

use library\backends\FileBackend;
use library\requests\AbstractRequest;
use library\responder\HtmlResponse;
use library\session\Session;
use PHPUnit\Framework\TestCase;

/**
 * Class DisplayBookFormProcessorTest
 * @package library\processor
 * @covers \library\processor\DisplayBookFormProcessor
 * @uses \library\session\Session
 * @uses \library\responder\HtmlResponse
 * @uses \library\requests\AbstractRequest
 * @uses \library\backends\FileBackend
 */
class DisplayBookFormProcessorTest extends TestCase
{
    /** @var DisplayBookFormProcessor */
    private $displayBookFormProcessor;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Session */
    private $session;

    /** @var \PHPUnit_Framework_MockObject_MockObject|HtmlResponse */
    private $response;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;

    /** @var \PHPUnit_Framework_MockObject_MockObject|FileBackend */
    private $fileBackend;

    /** @var string */
    private $xmlPath;
    /** @var string */
    private $xslPath;

    public function setUp()
    {
        $this->session = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(HtmlResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fileBackend = $this->getMockBuilder(FileBackend::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->xmlPath = __DIR__ . '/../../data/testNoError.xml';
        $this->xslPath = __DIR__ . '/../../data/testDisplay.xsl';


        $this->displayBookFormProcessor = new DisplayBookFormProcessor($this->xmlPath, $this->xslPath, $this->session, $this->fileBackend);
    }

    public function testExecuteOnXmlWithoutError()
    {
        $this->response->expects($this->once())
            ->method('setBody');

        $this->session->expects($this->once())
            ->method('resetErrorXml');

        $this->session->expects($this->once())
            ->method('hasError');

        $this->fileBackend->expects($this->once())
            ->method('load')
            ->with($this->xmlPath)
            ->willReturn(file_get_contents($this->xmlPath));


        $this->displayBookFormProcessor->execute($this->response, $this->request);
    }

    public function testExecuteOnXmlWithError()
    {
        $this->response->expects($this->once())
            ->method('setBody');

        $this->session->expects($this->once())
            ->method('resetErrorXml');

        $this->session->expects($this->once())
            ->method('hasError')
            ->willReturn(true);

        $errorDom = new \DOMDocument();
        $errorDom->load(__DIR__ . '/../../data/testError.xml');

        $this->session->expects($this->once())
            ->method('getErrorXml')
            ->willReturn($errorDom);

        $this->displayBookFormProcessor->execute($this->response, $this->request);
    }
}
