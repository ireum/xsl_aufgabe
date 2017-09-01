<?php

namespace library\responder
{


    use library\processor\AddBookProcessor;
    use library\processor\DisplayBookFormProcessor;
    use library\processor\ErrorPageProcessor;
    use library\processor\LibraryProcessor;
    use library\requests\AbstractRequest;
    use library\factories\Factory;
    use PHPUnit\Framework\TestCase;

    /**
     * Class OLDRouterTest
     * @package library\Routers
     * @covers library\Routers\Router
     * @uses   library\setup\Factory
     */
    class OLDRouterTest extends TestCase
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


        // TODO: How to test Redriects
//        public function testRouteReturnsLibraryProcessorIfCalledWithLibraryRedirect()
//        {
//            $this->uri->expects($this->once())
//                ->method('getPath')
//                ->willReturn('/library');
//
//            $actual = $this->router->route($this->request);
//            $this->assertInstanceOf(LibraryProcessor::class, $actual);
//        }

//        public function testRouteReturnsDisplayBookFormProcessorIfCalledWithAddBookFormRedirect()
//        {
//            $this->request->expects($this->once())
//                ->method('getPath')
//                ->willReturn('/add');
//            $actual = $this->router->route($this->request);
//            $this->assertInstanceOf(DisplayBookFormProcessor::class, $actual);
//        }
//
//        public function testRouteReturnsAddBookProcessorIfCalledWithValidationRedirect()
//        {
//            $this->request->expects($this->once())
//                ->method('getPath')
//                ->willReturn('/validate');
//            $actual = $this->router->route($this->request);
//            $this->assertInstanceOf(AddBookProcessor::class, $actual);
//        }

//        public function testRouteReturnsErrorPageProcessorIfCalledWithInvalidUri()
//        {
//            $actual = $this->router->route($this->request);
//            $this->assertInstanceOf(ErrorPageProcessor::class, $actual);
//        }


    }
}
