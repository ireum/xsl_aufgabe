<?php

namespace library\backends;

use PHPUnit\Framework\TestCase;
use SebastianBergmann\GlobalState\RuntimeException;

/**
 * Class FileBackendTest
 * @package library\backends
 * @covers \library\backends\FileBackend
 */
// TODO: Test Exceptions
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

    public function testSave()
    {
        $path = __DIR__ . '/../../data/fileBackendFile.txt';
        $data = 'TEST';
        $this->fileBackend->save($path, $data);
        $this->assertSame('TEST', file_get_contents($path));
        file_put_contents($path, '');
    }
}
