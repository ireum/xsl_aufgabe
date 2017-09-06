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
    class LibraryFilterTest extends TestCase
    {
        /** @var LibraryFilter */
        private $libraryFilter;

        /** @var \PHPUnit_Framework_MockObject_MockObject|BooksQuery */
        private $booksQuery;

        /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
        private $request;

        /** @var string */
        private $path;

        public function setUp()
        {
            $this->booksQuery = $this->getMockBuilder(BooksQuery::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->request = $this->getMockBuilder(AbstractRequest::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->path = __DIR__ . '/../../data/testBooks.xml';

            $this->libraryFilter = new LibraryFilter(
                $this->path,
                $this->booksQuery
            );
        }


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

        /**
         * @dataProvider defaultValueProvider
         */
        public function testProcessFormWithoutFilters($name, $value)
        {
            $this->request->expects($this->once())
                ->method('has')
                ->with('submit')
                ->willReturn(false);

            $this->booksQuery->expects($this->once())
                ->method('getMinPrice')
                ->willReturn(5.95);

            $this->booksQuery->expects($this->once())
                ->method('getMaxPrice')
                ->willReturn(44.95);

            $actual = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $actual);
            /** @var \DOMElement $root */
            $root = $actual->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));
        }

        public function searchValueProviderPrice()
        {
            return array(
                array('sortby', 'price'),
                array('sortdatatype', 'number'),
                array('author', 'Agus'),
                array('title', 'UE4'),
                array('minprice', 5.3),
                array('maxprice', 35.35)
            );
        }

        /**
         * @dataProvider searchValueProviderPrice
         */
        public function testProcessFormWithPriceFilter($name, $value)
        {
            $this->request->expects($this->once())
                ->method('has')
                ->with('submit')
                ->willReturn(true);

            //TODO: X YEEEEEEEEEEEEEEEES!
            $this->request->expects($this->any())
                ->method('get')
                ->will(
                    $this->returnValueMap(
                        array(
                            array('sort', 'price'),
                            array('author', 'Agus'),
                            array('title', 'UE4'),
                            array('minPrice', 5.3),
                            array('maxPrice', 35.35)
                        )
                    )
                );

            $actual = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $actual);
            /** @var \DOMElement $root */
            $root = $actual->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));
            $this->assertInstanceOf(\DOMDocument::class, $actual);
        }

        public function searchValueProviderText()
        {
            return array(
                array('sortby', 'title'),
                array('sortdatatype', 'text'),
                array('author', 'Agus'),
                array('title', 'UE4'),
                array('minprice', 5.3),
                array('maxprice', 35.35)
            );
        }

        /**
         * @dataProvider searchValueProviderText
         */
        public function testProcessFormWithTextFilter($name, $value)
        {
            $this->request->expects($this->once())
                ->method('has')
                ->with('submit')
                ->willReturn(true);

            $this->request->expects($this->any())
                ->method('get')
                ->will(
                    $this->returnValueMap(
                        array(
                            array('sort', 'title'),
                            array('author', 'Agus'),
                            array('title', 'UE4'),
                            array('minPrice', 5.3),
                            array('maxPrice', 35.35)
                        )
                    )
                );

            $actual = $this->libraryFilter->processForm($this->request);
            $this->assertInstanceOf(\DOMDocument::class, $actual);
            /** @var \DOMElement $root */
            $root = $actual->getElementsByTagName('catalog')[0];
            $this->assertTrue($root->hasAttribute($name));
            $this->assertEquals($value, $root->getAttribute($name));
            $this->assertInstanceOf(\DOMDocument::class, $actual);
        }
    }
}
