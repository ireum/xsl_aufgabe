<?php

namespace library\handler
{

    use library\requests\AbstractRequest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class LibraryFilterTest
     * @package library\Handler
     * @covers \library\handler\LibraryFilter
     * @uses   \library\requests\AbstractRequest
     */
    class LibraryFilterTest extends TestCase
    {
        /** @var LibraryFilter */
        private $libraryFilter;

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

            $this->libraryFilter = new LibraryFilter(__DIR__ . '/../../data/testBooks.xml', $this->xmlProcessor);
        }

        public function testProcessFormSetsDefaultValuesIfSubmitNotSet()
        {
            $dom = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }

        public function testProcessFormSetSearchedValues()
        {
            $this->request->expects($this->once())
                ->method('has')
                ->willReturn(true);

            $dom = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }

        public function testProcessFormSetSearchedValueWithPriceAsFilter()
        {
            $this->request->expects($this->once())
                ->method('has')
                ->willReturn(true);
//
            $this->request->expects($this->atLeast(2))
                ->method('get')
                ->willReturn('price');

            $dom = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }
    }
}
