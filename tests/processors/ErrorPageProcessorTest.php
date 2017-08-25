<?php

namespace library\processor
{

    use PHPUnit\Framework\TestCase;

    /**
     * Class ErrorPageProcessorTest
     * @package library\processor
     * @covers library\processor\errorPageProcessor
     * @uses  library\routing\HtmlResponse
     */
    class ErrorPageProcessorTest extends TestCase
    {
        /** @var ErrorPageProcessor */
        private $errorPageProcessor;

        private $htmlResponse;

        public function setUp()
        {
            $this->htmlResponse = $this->getMockBuilder()
                ->disableOriginalConstructor()
                ->getMock();

            $this->errorPageProcessor = new ErrorPageProcessor();
        }

        public function testExecuteSetsBodyToErrorPage()
        {
            
        }
    }
}
