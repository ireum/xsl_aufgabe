<?php

namespace library\processor;

use library\requests\AbstractRequest;
use library\routing\HtmlResponse;
use library\xmlhandler\XmlEditor;
use library\xmlhandler\XmlErrorGenerator;
use library\xmlhandler\XmlExceptionProcessor;
use PHPUnit\Framework\TestCase;

/**
 * Class AddBookProcessorTest
 * @package library\processor
 * @covers library\processor\AddBookProcessor
 * @uses library\book\Book
 */
class AddBookProcessorTest extends TestCase
{
    /** @var AddBookProcessor */
    private $addBookProcessor;

    /** @var \PHPUnit_Framework_MockObject_MockObject|XmlEditor */
    private $xmlEditor;

    /** @var \PHPUnit_Framework_MockObject_MockObject|XmlErrorGenerator */
    private $xmlErrorGenerator;

    /** @var \PHPUnit_Framework_MockObject_MockObject|HtmlResponse */
    private $htmlResponse;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;


    public function setUp()
    {
        $this->xmlEditor = $this->getMockBuilder(XmlEditor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->xmlErrorGenerator = $this->getMockBuilder(XmlErrorGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->htmlResponse = $this->getMockBuilder(HtmlResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->addBookProcessor = new AddBookProcessor($this->xmlEditor, $this->xmlErrorGenerator);
    }

    // TODO: How to test header
//    public function testExecute()
//    {
//        $this->addBookProcessor->execute($this->htmlResponse, $this->request);
//        $this->assertEquals('/add', $this->htmlResponse->getRedirect());
//    }

}
