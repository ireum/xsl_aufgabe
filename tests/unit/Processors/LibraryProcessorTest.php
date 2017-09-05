<?php

namespace library\processor;

use library\backends\FileBackend;
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
 * @uses \library\backends\FileBackend
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

    /** @var \PHPUnit_Framework_MockObject_MockObject|FileBackend */
    private $fileBackend;

    /** @var string */
    private $xslPath;

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


        $this->fileBackend = $this->getMockBuilder(FileBackend::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->xslPath = __DIR__ . '/../../data/testXsl.xsl';
        $this->fileBackend->expects($this->once())
            ->method('load')
            ->with($this->xslPath)
            ->willReturn(file_get_contents($this->xslPath));

        $this->libraryProcessor = new LibraryProcessor($this->libraryFilter, $this->xslPath, $this->fileBackend);
    }

    public function testExecuteE()
    {
        //TODO: X Zusicherung auf setBody mit ->with()
        $libDom = new \DOMDocument();
        $libDom->load(__DIR__ . '/../../data/testBooks.xml');
        $root = $libDom->getElementsByTagName('catalog')->item(0);
        $root->setAttribute('sortby', 'author');
        $root->setAttribute('sortdatatype', 'text');
        $root->setAttribute('author', '');
        $root->setAttribute('title', '');
        $root->setAttribute('minprice', 0);
        $root->setAttribute('maxprice', 100);

        $this->libraryFilter->expects($this->exactly(2))
            ->method('processForm')
            ->willReturn($libDom);

        $this->libraryProcessor = new LibraryProcessor($this->libraryFilter, $this->xslPath, $this->fileBackend);


        $xslParser = new \XSLTProcessor();
        $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

        $this->response->expects($this->once())
            ->method('setBody')
            ->with($xslParser->transformToDoc($this->libraryFilter->processForm($this->request))->saveXML());


        $this->libraryProcessor->execute($this->response, $this->request);
    }
}
