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
 * @uses library\processor\Processors
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

    public function testRouteReturnsLibraryProcessorIfCalledWithLibraryPath()
    {
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($this->uri);

        $this->uri->expects($this->once())
            ->method('getPath')
            ->willReturn('/library');

        $actual = $this->router->route($this->request);
        $this->assertInstanceOf(LibraryProcessor::class, $actual);
    }

    public function testRouteReturnsDisplayBookProcessorIfCalledWithAddPath()
    {
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($this->uri);

        $this->uri->expects($this->once())
            ->method('getPath')
            ->willReturn('/add');

        $actual = $this->router->route($this->request);
        $this->assertInstanceOf(DisplayBookFormProcessor::class, $actual);
    }

    public function testRouteReturnsAddBookProcessorIfCalledWithValidatePath()
    {
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($this->uri);

        $this->uri->expects($this->once())
            ->method('getPath')
            ->willReturn('/validate');

        $actual = $this->router->route($this->request);
        $this->assertInstanceOf(AddBookProcessor::class, $actual);
    }

    public function testRouteReturnsErrorPageProcessorIfCalledWithAnyInvalidPath()
    {
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($this->uri);

        $this->uri->expects($this->once())
            ->method('getPath')
            ->willReturn('/invalidpath');

        $actual = $this->router->route($this->request);
        $this->assertInstanceOf(ErrorPageProcessor::class, $actual);
    }



    public function testRouteReturnsErrorPageProcessorIfCalledWitEmptyPath()
    {
        $this->request->expects($this->once())
            ->method('getUri')
            ->willReturn($this->uri);

        $this->uri->expects($this->once())
            ->method('getPath')
            ->willReturn('');

        $actual = $this->router->route($this->request);
        $this->assertInstanceOf(ErrorPageProcessor::class, $actual);
    }
}
