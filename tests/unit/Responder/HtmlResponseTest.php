<?php

namespace library\responder;

use PHPUnit\Framework\TestCase;

/**
 * Class HtmlResponseTest
 * @package library\responder
 * @covers library\responder\HtmlResponse
 */
class HtmlResponseTest extends TestCase
{

    /** @var HtmlResponse */
    private $htmlResponse;

    public function setUp()
    {
        $this->htmlResponse = new HtmlResponse();
    }

    public function testSetBodySetsStringInsertedBySetBody()
    {
        $this->htmlResponse->setBody('body');
        $actual = $this->htmlResponse->getBody();
        $this->assertEquals('body', $actual);
    }

    public function testGetBodyThrowsExceptionWhenBodyIsNull()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Body is empty');
        $this->htmlResponse->getBody();
    }

    public function testHasRedirectReturnsTrueIfRedirectIsSet()
    {
        $this->htmlResponse->setRedirect('/redirect');
        $this->assertTrue($this->htmlResponse->hasRedirect());
    }

    public function testHasRedirectReturnsFalseIfRedirectIsNotSet()
    {
        $this->assertFalse($this->htmlResponse->hasRedirect());
    }

    public function testGetRedirectReturnsStringInsertedBySetRedirect()
    {
        $this->htmlResponse->setRedirect('/redirect');
        $this->assertEquals('/redirect', $this->htmlResponse->getRedirect());
    }

}
