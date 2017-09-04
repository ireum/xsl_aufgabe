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
        private $booksQuery;

        /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
        private $request;

        public function setUp()
        {
            $this->booksQuery = $this->getMockBuilder(BooksQuery::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->request = $this->getMockBuilder(AbstractRequest::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->libraryFilter = new LibraryFilter(__DIR__ . '/../../data/testBooks.xml', $this->booksQuery);
        }


        public function defaultValueProvider()
        {
            return array(
                array('sortby', 'author'),
                array('sortdatatype', 'text'),
                array('author', ''),
                array('title', ''),
                array('minprice', 5.95),
                array('maxprice', 44.95)
            );
        }

        /**
         * @dataProvider defaultValueProvider
         */
        public function testProcessFormSetsDefaultValuesIfSubmitNotSet($name, $value)
        {
            $this->booksQuery->expects($this->once())
                ->method('getMinPrice')
                ->willReturn(5.95);

            $this->booksQuery->expects($this->once())
                ->method('getMaxPrice')
                ->willReturn(44.95);

            $dom = $this->libraryFilter->processForm($this->request);
            //TODO: X Zusicherung auf Attribute von private function setDefaultValues()
            /** @var \DOMElement $root */
            $root = $dom->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
//            var_dump($root->getAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));

            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }

        public function searchedValueProvider()
        {
            return array(
                array('sortby', 'title'),
                array('sortdatatype', 'text'),
                array('author', 'Agus'),
                array('title', 'UE4'),
                array('minprice', 5.95),
                array('maxprice', 44.95)
            );
        }

        /**
         * @dataProvider searchedValueProvider
         */
        public function testProcessFormSetSearchedValues($name, $value)
        {
            $this->request->expects($this->once())
                ->method('has')
                ->with('submit')
                ->willReturn(true);

            //TODO: Zusicherung auf Attribute

            $dom = $this->libraryFilter->processForm($this->request);

            /** @var \DOMElement $root */
            $root = $dom->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
//            var_dump($root->getAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));



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

            //TODO: Zusichung auf Attribute




            $dom = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }
    }
}
