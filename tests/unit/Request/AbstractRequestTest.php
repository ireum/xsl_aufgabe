<?php

namespace library\requests;

use library\responder\Uri;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\GlobalState\RuntimeException;

/**
 * Class AbstractRequestTest
 * @package library\requests
 * @covers library\requests\AbstractRequest
 * @covers library\requests\PostRequest
 * @covers library\requests\GetRequest
 * @uses library\responder\Uri
 */
class AbstractRequestTest extends TestCase
{
    /** @var PostRequest|GetRequest */
    private $abstractRequest;

    public function setUp()
    {
        $inputVariables = ['foo' => 'bar', 'bar' => 'baz'];
        $server = ['REQUEST_URI' => 'https://www.library.test.ch/path'];
        $this->abstractRequest = new PostRequest($inputVariables, $server);
    }

    public function testHasReturnsFalseIfKeyIsNotSet()
    {
        $this->assertFalse($this->abstractRequest->has('test'));
    }

    public function testHasReturnstrueIfKeyIsSet()
    {
        $this->assertTrue($this->abstractRequest->has('foo'));
    }

    public function testGetReturnsValueOfKeyIfKeyIsSet()
    {
        $this->assertSame('bar', $this->abstractRequest->get('foo'));
    }

    public function testGetReturnsEmptyStringIfKeyIsNotSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->abstractRequest->get('test');
    }

    public function testGetUriReturnsUriObject()
    {
        $actual = $this->abstractRequest->getUri();
        $this->assertSame('/path', $actual->getPath());
        $this->assertInstanceOf(Uri::class, $actual);
    }


}
