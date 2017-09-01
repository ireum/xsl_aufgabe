<?php

namespace library\processor;

use library\handler\LibraryFilter;
use library\requests\AbstractRequest;
use library\responder\HtmlResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class LibraryProcessorTest
 * @package library\processor
 * @covers \library\processor\LibraryProcessor
 * @uses \library\handler\LibraryFilter
 * @uses \library\responder\HtmlResponse
 */
class LibraryProcessorTest extends TestCase
{
    /** @var LibraryProcessor */
    private $libraryProcessor;

    /** @var \PHPUnit_Framework_MockObject_MockObject|LibraryFilter */
    private $libraryFilter;

    /** @var \PHPUnit_Framework_MockObject_MockObject|HtmlResponse */
    private $response;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;

    public function setUp()
    {
        $this->libraryFilter = $this->getMockBuilder(LibraryFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(HtmlResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $xslPath = __DIR__ . '/../../data/testXsl.xsl';

        $this->libraryProcessor = new LibraryProcessor($this->libraryFilter, $xslPath);
    }

    public function testExecute()
    {
        $libDom = new \DOMDocument();
        $libDom->load(__DIR__ . '/../../data/testBooks.xml');
        $root = $libDom->getElementsByTagName('catalog')->item(0);
        $root->setAttribute('sortby', 'author');
        $root->setAttribute('sortdatatype', 'text');
        $root->setAttribute('author', '');
        $root->setAttribute('title', '');
        $root->setAttribute('minprice', 0);
        $root->setAttribute('maxprice', 100);

        $this->libraryFilter->expects($this->once())
            ->method('processForm')
            ->willReturn($libDom);

        $this->libraryProcessor->execute($this->response, $this->request);
    }
}
