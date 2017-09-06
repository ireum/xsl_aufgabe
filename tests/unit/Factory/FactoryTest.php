<?php

namespace library\factories;

use library\backends\FileBackend;
use library\Configuration;
use library\handler\BookAppender;
use library\handler\BooksQuery;
use library\handler\ErrorXmlGenerator;
use library\handler\LibraryFilter;
use library\processor\AddBookProcessor;
use library\processor\DisplayBookFormProcessor;
use library\processor\ErrorPageProcessor;
use library\processor\LibraryProcessor;
use library\routers\Router;
use library\session\Session;
use library\valueobject\Book;
use PHPUnit\Framework\TestCase;

/**
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
 * @uses    \library\backends\FileBackend
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

    //TODO: X Via DataProvider löschen

    public function provider()
    {
        return array(
            array('createLibraryFilter', LibraryFilter::class),
            array('createBookAppender', BookAppender::class),
            array('createFileBackend', FileBackend::class),
            array('createAddBookProcessor', AddBookProcessor::class),
            array('createDisplayBookProcessor', DisplayBookFormProcessor::class),
            array('createLibraryProcessor', LibraryProcessor::class),
            array('createErrorPageProcessor', ErrorPageProcessor::class),
            array('createRouter', Router::class),
            array('createErrorXmlGenerator', ErrorXmlGenerator::class),
        );
    }

    /**
     * @dataProvider provider
     */
    public function testFactory($methodToCall, $expected)
    {
        $this->configuration->expects($this->any())->method('getXmlPath')->willReturn(__DIR__ . '/../../data/testBooks.xml');

        $this->assertInstanceOf($expected, $this->factory->{$methodToCall}());
    }
}
