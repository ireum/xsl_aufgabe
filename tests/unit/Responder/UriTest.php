<?php

namespace library\responder;

use PHPUnit\Framework\TestCase;

/**
 * Class UriTest
 * @package library\responder
 * @covers library\responder\Uri
 */
class UriTest extends TestCase
{

    /** @var Uri */
    private $uri;

    public function setUp()
    {
        $uri = 'https://library.test.ch/path';
        $this->uri = new Uri($uri);
    }

    public function testGetPathReturnsPathInsertedByConstructor()
    {
        $expected = '/path';
        $actual = $this->uri->getPath();
        $this->assertEquals($expected, $actual);
    }


}
