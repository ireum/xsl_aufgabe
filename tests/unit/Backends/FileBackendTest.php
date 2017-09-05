<?php

namespace library\backends;

use PHPUnit\Framework\TestCase;

/**
 * Class FileBackendTest
 * @package library\backends
 * @covers \library\backends\FileBackend
 */
class FileBackendTest extends TestCase
{
    /** @var FileBackend */
    private $fileBackend;

    public function setUp()
    {
        $this->fileBackend = new FileBackend();
    }

    public function testLoad()
    {
        $path = __DIR__ . '/../../data/validTestConf.ini';
        $expected = file_get_contents($path);
        $actual = $this->fileBackend->load($path);
        $this->assertEquals($expected, $actual);
    }

    //TODO: Test Save
    public function testSave()
    {
        
    }
}
