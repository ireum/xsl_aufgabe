<?php

namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\responder\HtmlResponseTest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class ErrorPageProcessorTest
     * @package library\processor
     * @covers library\processor\errorPageProcessor
     * @uses  library\routing\HtmlResponse
     * @uses library\requests\AbstractRequest
     */
    class ErrorPageProcessorTest extends TestCase
    {
        /** @var ErrorPageProcessor */
        private $errorPageProcessor;

        /** @var \PHPUnit_Framework_MockObject_MockObject|HtmlResponse */
        private $htmlResponse;

        /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
        private $abstractRequest;

        public function setUp()
        {
            $this->htmlResponse = $this->getMockBuilder(HtmlResponse::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->htmlResponse = new HtmlResponse();

            $this->abstractRequest = $this->getMockBuilder(AbstractRequest::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->errorPageProcessor = new ErrorPageProcessor();
        }

        public function testExecuteSetsBodyToErrorPage()
        {
//            $this->htmlResponse->expects($this->once())
//                ->method('getBody')
//                ->willReturn('TEST');

            $this->errorPageProcessor->execute($this->htmlResponse, $this->abstractRequest);
            $this->assertSame('<html><h1>Error: 404</h1></html>', $this->htmlResponse->getBody());
        }
    }
}
