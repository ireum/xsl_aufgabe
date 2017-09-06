<?php

namespace library\handler;

use library\backends\FileBackend;
use library\requests\AbstractRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class ErrorXmlGeneratorTest
 * @package library\handler
 * @cover \library\handler\ErrorXmlGenerator
 * @uses \library\requests\AbstractRequest
 * @uses \library\backends\FileBackend
 */
class ErrorXmlGeneratorTest extends TestCase
{
    /** @var ErrorXmlGenerator */
    private $errorXmlGenerator;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;

    /** @var \PHPUnit_Framework_MockObject_MockObject|FileBackend */
    private $fileBackend;

    public function setUp()
    {
        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->fileBackend = $this->getMockBuilder(FileBackend::class)
            ->disableOriginalConstructor()
            ->getMock();

        $path = __DIR__ . '/../../data/testError.xml';
        $this->fileBackend->expects($this->once())
            ->method('load')
            ->with($path)
            ->willReturn(file_get_contents($path));

        $this->errorXmlGenerator = new ErrorXmlGenerator($path, $this->fileBackend);
    }

    public function testGenerateXml()
    {
        $errorFields = ['price' => -1];

        $actual = $this->errorXmlGenerator->generateXml($errorFields, $this->request);
        $this->assertInstanceOf(\DOMDocument::class, $actual);

        $xpath = new \DOMXPath($actual);
        /** @var \DOMElement $priceField */
        $priceField = $xpath->query('/formData/fields/price')[0];
        $this->assertTrue($priceField->hasAttribute('invalidField'));
    }
}
