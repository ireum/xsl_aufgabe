<?php

namespace library\handler
{

    use library\requests\AbstractRequest;
    use library\requests\PostRequest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class LibraryFilterTest
     * @package library\Handler
     * @covers \library\handler\LibraryFilter
     * @uses   \library\requests\AbstractRequest
     */
    //TODO: Can't mock request!
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
            $this->booksQuery = $this->getMockBuilder(BooksQuery::class)->disableOriginalConstructor()->getMock();

            $inputVariables = [
                'submit' => 'Submit',
                'sort' => 'price',
                'sortdatatype' => 'number',
                'author' => 'Agus',
                'title' => 'UE4',
                'minPrice' => '1',
                'maxPrice' => '50',
            ];

            $this->request = $this->getMockBuilder(AbstractRequest::class)
//                ->setConstructorArgs(array($inputVariables, $_SERVER))
                    ->disableOriginalConstructor()
                ->getMock();

            $this->libraryFilter = new LibraryFilter(__DIR__ . '/../../data/testBooks.xml', $this->booksQuery);
        }


//        /**
//         * @dataProvider inputVarProvider
//         */
//        public function testTest($reqArr)
//        {
//
//            $this->request = $this->getMockBuilder(AbstractRequest::class)
//                ->setConstructorArgs(array($reqArr, $_SERVER))
//                ->getMock();
//
//            $this->libraryFilter = new LibraryFilter(__DIR__ . '/../../data/testBooks.xml', $this->booksQuery);
//
//            $dom = $this->libraryFilter->processForm($this->request);
//            $this->assertInstanceOf(\DOMDocument::class, $dom);
//        }

        public function defaultValueProvider()
        {
            return array(
                array('sortby', 'author'),
                array('sortdatatype', 'text'),
                array('author', ''),
                array('title', ''),
                array('minprice', 5.95),
                array('maxprice', 44.95));
        }

        public function inputVarProvider()
        {
            return array(
//                    array('submit', 'Submit'),
                    array('sort', 'author'),
                    array('sortdatatype', 'text'),
                    array('author', 'Agus'),
                    array('title', 'UE4'),
                    array('minPrice', '1'),
                    array('maxPrice', '50'));
        }

        public function inputVarPriceProvider()
        {
                array(
                    array('submit' => 'Submit'),
                    array('sort' => 'price'),
                    array('sortdatatype' => 'number'),
                    array('author' => 'Agus'),
                    array('title' => 'UE4'),
                    array('minPrice' => '1'),
                    array('maxPrice' => '50'));
        }

        /**
         * @dataProvider defaultValueProvider
         */
        public function testProcessFormSetsDefaultValuesIfSubmitNotSet($name, $value)
        {
            //TODO: X Zusicherung auf Attribute von private function setDefaultValues()
            $this->booksQuery->expects($this->once())
                ->method('getMinPrice')
                ->willReturn(5.95);

            $this->booksQuery->expects($this->once())
                ->method('getMaxPrice')
                ->willReturn(44.95);

            $dom = $this->libraryFilter->processForm($this->request);
            /** @var \DOMElement $root */
            $root = $dom->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }

        /**
         * @dataProvider inputVarProvider
         */
        public function testProcessFormSetSearchedValueWithPriceAsFilter($name, $value)
        {
            $inputVariables = [
            'submit' => 'Submit',
            'sort' => 'price',
            'sortdatatype' => 'number',
            'author' => 'Agus',
            'title' => 'UE4',
            'minPrice' => '1',
            'maxPrice' => '50',
        ];

            $this->request = $this->getMockBuilder(AbstractRequest::class)
                ->setConstructorArgs(array($inputVariables, $_SERVER))
                ->getMock();

            $this->request->expects($this->any())
                ->method('get')
                ->with($name)
                ->willReturn($inputVariables[$name]);

            $this->libraryFilter = new LibraryFilter(__DIR__ . '/../../data/testBooks.xml', $this->booksQuery);
            //TODO: Zusichung auf Attribute

            $this->request->expects($this->once())
                ->method('has')
                ->with('submit')
                ->willReturn(true);

            $dom = $this->libraryFilter->processForm($this->request);
            /** @var \DOMElement $root */
            $root = $dom->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));
            $this->assertInstanceOf(\DOMDocument::class, $dom);
        }
    }
}
