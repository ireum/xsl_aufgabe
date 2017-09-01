<?php

namespace library\handler;

use library\requests\AbstractRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class ErrorXmlGeneratorTest
 * @package library\handler
 * @cover \library\handler\ErrorXmlGenerator
 * @uses \library\requests\AbstractRequest
 */
class ErrorXmlGeneratorTest extends TestCase
{
    /** @var ErrorXmlGenerator */
    private $errorXmlGenerator;

    /** @var AbstractRequest */
    private $request;

    public function setUp()
    {
        $this->request = $this->getMockBuilder(AbstractRequest::class)->disableOriginalConstructor()->getMock();

        $path = __DIR__ . '/../../data/testError.xml';
        $this->errorXmlGenerator = new ErrorXmlGenerator($path);
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
