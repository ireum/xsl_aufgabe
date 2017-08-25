<?php

namespace library\setup;

use PHPUnit\Framework\TestCase;

/**
 * Class ConfigurationTest
 * @package library\setup
 * @covers library\setup\Configuration
 */
class ConfigurationTest extends TestCase
{
    /** @var Configuration */
    private $config;

    public function setUp()
    {
        $this->config = new Configuration(__DIR__ . '/data/conf.ini');
    }

    public function testGetXmlPathReturnsPathFromIniFile()
    {
        $expected = '/data/www/xls_aufgabe/src/setup/../book/xmlFile.xml';
        $actual = $this->config->getXmlPath();
        $this->assertEquals($expected, $actual);
    }

    public function testGetXslPathReturnsPathFromIniFile()
    {
        $expected = '/data/www/xls_aufgabe/src/setup/../pages/xslFile.xsl';
        $actual = $this->config->getXslPath();
        $this->assertEquals($expected, $actual);
    }

    public function testGetXmlAddBookPathFromIniFile()
    {
        $expected = '/data/www/xls_aufgabe/src/setup/../pages/xmlFileTwo.xml';
        $actual = $this->config->getXmlAddBookPath();
        $this->assertEquals($expected, $actual);
    }

        // TODO: Throws no Exception?
//    public function testIsInvalidIniFileThrowsExceptionIfInvalidIniFile()
//    {
////        $this->expectException(\InvalidArgumentException::class);
//        $this->config = new Configuration(__DIR__ . '/data/unittest.ini');
//    }
}
