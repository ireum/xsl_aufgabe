<?php

namespace library\requests;

use library\routing\Uri;
use PHPUnit\Framework\TestCase;

/**
 * Class PostRequestTest
 * @package library\requests
 * @covers library\requests\PostRequest
 * @covers library\requests\GetRequest
 * @covers library\requests\AbstractRequest
 */
class PostRequestTest extends TestCase
{
    /** @var PostRequest */
    private $abstractRequest;

    public function setUp()
    {
        $this->abstractRequest = new PostRequest(['foo' => 'bar', 'bar' => 'baz']);
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

    public function testGetThrowsRuntimeExceptionIfKeyIsNotSet()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Key "test" not found');
        $this->abstractRequest->get('test');
    }

    // TODO: How to test $_SERVER['REQUEST_URI']
//    public function testGetUrireturnsUriObject()
//    {
//        $this->assertInstanceOf(Uri::class, $this->postRequest->getUri());
//    }
    

}
