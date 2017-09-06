<?php

namespace library\backends;

use library\exceptions\ErrorException;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\GlobalState\RuntimeException;

/**
 * Class FileBackendTest
 * @package library\backends
 * @covers \library\backends\FileBackend
 * @uses \library\exceptions\ErrorException
 */
// TODO: X Test Exceptions
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

    public function testLoadInvalidFileThrowsErrorExceptions()
    {
        $this->expectException(ErrorException::class);
        $this->fileBackend->load('/tmp/any/dir/test.txt');
    }

    public function testSaveInvalidFileThrowsErrorException()
    {
        $this->expectException(ErrorException::class);
        $this->fileBackend->save('/tmp/any/directory/test.txt', 'data');
    }
}
