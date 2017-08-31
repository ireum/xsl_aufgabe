<?php

namespace library\xmlhandler
{

    use library\requests\AbstractRequest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class XmlFormProcessorTest
     * @package library\xmlhandler
     * @covers library\xmlhandler\XmlFormProcessor
     * @uses   library\requests\AbstractRequest
     */
    class XmlFormProcessorTest extends TestCase
    {
        /** @var XmlLibraryFilter */
        private $xmlFormProcessor;

        /** @var \PHPUnit_Framework_MockObject_MockObject|XmlQuery */
        private $xmlProcessor;

        /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
        private $request;

        public function setUp()
        {
            $this->xmlProcessor = $this->getMockBuilder(XmlQuery::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->request = $this->getMockBuilder(AbstractRequest::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->xmlFormProcessor = new XmlLibraryFilter(__DIR__ . '/data/test.xml', $this->xmlProcessor);
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
