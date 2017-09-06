<?php

namespace library;

use library\exceptions\ErrorException;
use PHPUnit\Framework\Error\Error;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationTest
 * @package library
 * @covers \library\Configuration
 * @uses \library\exceptions\ErrorException
 */
class ConfigurationTest extends TestCase
{
    /** @var Configuration */
    private $configuration;

    public function setUp()
    {
        $path = __DIR__ . '/../data/validTestConf.ini';
        $this->configuration = new Configuration($path);
    }

    public function testIsValidIniFileThrowsExceptionIfIniIsInvalid()
    {
        $this->expectException(ErrorException::class);
        $path = __DIR__ . '/../data/invalidTestConf.ini';
        $this->configuration = new Configuration($path);
    }

    public function testGetXmlPathReturnsCorrectFileFromIni()
    {
        $expected = '/data/www/xls_aufgabe/src/../data/xmlPath.xml';
        $actual = $this->configuration->getXmlPath();
        $this->assertEquals($expected, $actual);
    }

    public function testGetXslPathReturnsCorrectFileFromIni()
    {
        $expected = '/data/www/xls_aufgabe/src/../xsl/xslPath.xsl';
        $actual = $this->configuration->getXslPath();
        $this->assertEquals($expected, $actual);
    }

    public function testGetAddBookXmlPathReturnsCorrectFileFromIni()
    {
        $expected = '/data/www/xls_aufgabe/src/../data/xmlPath2.xml';
        $actual = $this->configuration->getXmlAddBookPath();
        $this->assertEquals($expected, $actual);
    }

    public function testGetAddBookXslPathReturnsCorrectFileFromIni()
    {
        $expected = '/data/www/xls_aufgabe/src/../xsl/xslPath2.xsl';
        $actual = $this->configuration->getXslAddBookPath();
        $this->assertEquals($expected, $actual);
    }
}
