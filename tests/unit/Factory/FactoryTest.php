<?php

namespace library\factories;

use library\Configuration;
use library\handler\BookAppender;
use library\handler\ErrorXmlGenerator;
use library\handler\LibraryFilter;
use library\processor\AddBookProcessor;
use library\processor\DisplayBookFormProcessor;
use library\processor\ErrorPageProcessor;
use library\processor\LibraryProcessor;
use library\routers\Router;
use library\session\Session;
use PHPUnit\Framework\TestCase;

/**
 * Class FactoryTest
 * @package library\factories
 * @covers  \library\factories\Factory
 * @uses    \library\Configuration
 * @uses    \library\session\Session
 * @uses    \library\handler\BookAppender
 * @uses    \library\handler\BooksQuery
 * @uses    \library\routers\Router
 * @uses    \library\processor\AddBookProcessor
 * @uses    \library\processor\DisplayBookFormProcessor
 * @uses    \library\processor\ErrorPageProcessor
 * @uses    \library\processor\LibraryProcessor
 * @uses    \library\handler\LibraryFilter
 * @uses    \library\handler\ErrorXmlGenerator
 */
class FactoryTest extends TestCase
{

    /** @var Factory */
    private $factory;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Configuration */
    private $configuration;

    /** @var \PHPUnit_Framework_MockObject_MockObject|Session */
    private $session;

    public function setUp()
    {
        $this->configuration = $this->getMockBuilder(Configuration::class)->disableOriginalConstructor()->getMock();

        $this->session = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->getMock();

        $this->factory = new Factory($this->configuration, $this->session);
    }

    public function testLibraryFilterCanBeCreated()
    {
        $this->configuration->expects($this->any())->method('getXmlPath')->willReturn(__DIR__ . '/../../data/testBooks.xml');

        $actual = $this->factory->createLibraryFilter();
        $this->assertInstanceOf(LibraryFilter::class, $actual);
    }

    public function testBookAppenderCanBeCreated()
    {
        $this->configuration->expects($this->any())->method('getXmlPath')->willReturn(__DIR__ . '/../../data/testBooks.xml');

        $actual = $this->factory->createBookAppender();
        $this->assertInstanceOf(BookAppender::class, $actual);
    }

    public function testAddBookProcessorCanBeCreated()
    {
        $this->configuration->expects($this->any())->method('getXmlPath')->willReturn(__DIR__ . '/../../data/testBooks.xml');

        $actual = $this->factory->createAddBookProcessor();
        $this->assertInstanceOf(AddBookProcessor::class, $actual);
    }

    public function testDisplayBookFormProcessorCanBeCreated()
    {
        $this->configuration->expects($this->any())->method('getXmlPath')->willReturn(__DIR__ . '/../../data/testBooks.xml');

        $actual = $this->factory->createDisplayBookProcessor();
        $this->assertInstanceOf(DisplayBookFormProcessor::class, $actual);
    }


    public function testLibraryProcessorCanBeCreated()
    {
        $this->configuration->expects($this->any())->method('getXmlPath')->willReturn(__DIR__ . '/../../data/testBooks.xml');

        $actual = $this->factory->createLibraryProcessor();
        $this->assertInstanceOf(LibraryProcessor::class, $actual);
    }

    public function testErrorPageProcessorCanBeCreated()
    {
        $actual = $this->factory->createErrorPageProcessor();
        $this->assertInstanceOf(ErrorPageProcessor::class, $actual);
    }

    public function testRouterCanBeCreated()
    {
        $actual = $this->factory->createRouter();
        $this->assertInstanceOf(Router::class, $actual);
    }

    public function testErrorXmlGeneratorCanBeCreated()
    {
        $actual = $this->factory->createErrorXmlGenerator();
        $this->assertInstanceOf(ErrorXmlGenerator::class, $actual);
    }
}
