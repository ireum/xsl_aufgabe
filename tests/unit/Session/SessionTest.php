<?php

namespace library\session;

use PHPUnit\Framework\TestCase;

/**
 * Class SessionTest
 * @package library\session
 * @covers library\session\Session
 */
class SessionTest extends TestCase
{
    /** @var Session */
    private $session;

    public function setUp()
    {
        $inputVriables = ['foo' => 'bar', 'errorXml' => '<?xml version="1.0"?>
<?xml-stylesheet type="text/xsl" href="xslt.xsl"?><test></test>'];
        $this->session = new Session($inputVriables);
    }

    public function testSetSetsValueInInputvariables()
    {
        $this->session->set('bar', 'baz');
        $actual = $this->session->get('bar');
        $this->assertEquals('baz', $actual);
    }

    public function testGetReturnsStringInsertedByConstructor()
    {
        $actual = $this->session->get('foo');
        $this->assertEquals('bar', $actual);
    }

    public function testGetThrowsInvalidArgumentExceptionIfKeyIsNotSet()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Key "baz" not found');
        $this->session->get('baz');
    }

    public function testHasErrorReturnsTrueIfSet()
    {
        $this->assertTrue($this->session->hasError());
    }

    public function testGetErrorXmlReturnsXmlInsertedByConstructor()
    {

        $actual = $this->session->getErrorXml();
        $this->assertInstanceOf(\DOMDocument::class, $actual);
    }

    

//    public function testSetErrorXmlSetXmlIntoInputVariables()
//    {
//
//        $this->session->setErrorXml();
//    }


}
