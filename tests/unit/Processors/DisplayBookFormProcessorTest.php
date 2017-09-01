<?php

namespace library\processor;

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

        $xmlPath = __DIR__ . '/../../data/testNoError.xml';
        $xslPath = __DIR__ . '/../../data/testDisplay.xsl';

        $this->displayBookFormProcessor = new DisplayBookFormProcessor($xmlPath, $xslPath, $this->session);
    }

    public function testExecuteOnXmlWithoutError()
    {
        $this->response->expects($this->once())
            ->method('setBody');

        $this->session->expects($this->once())
            ->method('resetErrorXml');

        $this->session->expects($this->once())
            ->method('hasError');


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
