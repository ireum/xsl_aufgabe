<?php

namespace library\handler
{

    use library\requests\AbstractRequest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class XmlFormProcessorTest
     * @package library\Handler
     * @covers library\Handler\XmlFormProcessor
     * @uses   library\requests\AbstractRequest
     */
    class XmlFormProcessorTest extends TestCase
    {
        /** @var LibraryFilter */
        private $xmlFormProcessor;

        /** @var \PHPUnit_Framework_MockObject_MockObject|BooksQuery */
        private $xmlProcessor;

        /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
        private $request;

        public function setUp()
        {
            $this->xmlProcessor = $this->getMockBuilder(BooksQuery::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->request = $this->getMockBuilder(AbstractRequest::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->xmlFormProcessor = new LibraryFilter(__DIR__ . '/data/test.xml', $this->xmlProcessor);
        }

        public function testProcessFormSetsDefaultValuesIfSubmitNotSet()
        {
            $dom = $this->xmlFormProcessor->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }

        public function testProccesFormSetSearchedValues()
        {
            $this->request->expects($this->once())
                ->method('has')
                ->willReturn(true);

            $dom = $this->xmlFormProcessor->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }

        public function testProcessFormSetSearchedValueWithPriceAsFilter()
        {
            $this->request->expects($this->once())
                ->method('has')
                ->willReturn(true);
//
//            $this->request->expects($this->atLeast(1))
//                ->method('get')
//                ->with('author');

            $this->request->expects($this->atLeast(2))
                ->method('get')
                ->willReturn('price');

            $dom = $this->xmlFormProcessor->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }
    }
}
