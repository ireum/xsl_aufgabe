<?php

namespace library\responder
{

    use PHPUnit\Framework\TestCase;

    /**
     * @covers library\routing\Uri
     */
    class UriTest extends TestCase
    {
        /** @var Uri */
        private $uri;

        public function setUp()
        {
            $this->uri = new Uri('http://ww.test.com/test?test');
        }

        public function testGetPathReturnsPathInsertedByConstructor()
        {
            $this->assertEquals('/test', $this->uri->getPath());
        }

    }
}
