<?php

namespace library\responder
{

    use PHPUnit\Framework\TestCase;

    /**
     * @covers library\routing\HtmlResponse
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
            $this->htmlResponse->setBody('test');
            $this->assertEquals('test', $this->htmlResponse->getBody());
        }

        public function testGetBodyThrowsExceptionWhenBodyIsNull()
        {
            $this->expectException(\Exception::class);
            $this->expectExceptionMessage('Body is empty');
            $this->htmlResponse->getBody();
        }

//        public function testHasRedirectReturnsTrueIfRedirectIsSet()
//        {
//            $this->htmlResponse->setRedirect('/redirect');
//            $this->assertTrue($this->htmlResponse->hasRedirect());
//        }
//
//        public function testHasRedirectReturnsFalseIfRedirectIsNotSet()
//        {
//            $this->assertFalse($this->htmlResponse->hasRedirect());
//        }

//        public function testGetHeaderThrowsExceptionIfRedirectIsNotSet()
//        {
//        }

        // TODO: Test Header

//        public function testSetRedirectSetsStringInsertedBySetRedirect()
//        {
//            $this->htmlResponse->setRedirect('/redirect');
//            $this->assertEquals('Location: /redirect', $this->htmlResponse->getRedirect());
//        }
    }
}
