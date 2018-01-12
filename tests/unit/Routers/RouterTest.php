<?php

namespace library\routers;

use library\factories\Factory;
use library\processor\AddBookProcessor;
use library\processor\DisplayBookFormProcessor;
use library\processor\ErrorPageProcessor;
use library\processor\LibraryProcessor;
use library\requests\AbstractRequest;
use library\responder\Uri;
use PHPUnit\Framework\TestCase;

/**
 * Class RouterTest
 * @package library\routers
 * @covers library\routers\Router
 * @uses library\factories\Factory
 * @uses library\responder\Uri
 * @uses library\requests\AbstractRequest
 */
class RouterTest extends TestCase
{
    /** @var Router */
    private $router;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Factory */
    private $factory;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
    private $request;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Uri */
    private $uri;

    public function setUp()
    {
        $this->factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->request = $this->getMockBuilder(AbstractRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->uri = $this->getMockBuilder(Uri::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->router = new Router($this->factory);
    }

    public function provider()
    {
        return array(
            array('/library', LibraryProcessor::class),
            array('/add', DisplayBookFormProcessor::class),
            array('/validate', AddBookProcessor::class),
            array('/invalidPath', ErrorPageProcessor::class),
            array('', ErrorPageProcessor::class),
        );
    }

    /**
     * @dataProvider provider
     */
    public function testReturnedObjectsWithPath($path, $Class)
    {
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($this->uri);

        $this->uri->expects($this->once())
            ->method('getPath')
            ->willReturn($path);

        $actual = $this->router->route($this->request);
        $this->assertInstanceOf($Class, $actual);
    }
}
