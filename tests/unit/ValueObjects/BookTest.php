<?php

namespace library\valueobject
{

    use library\exceptions\InvalidBookException;
    use library\requests\AbstractRequest;
    use library\requests\PostRequest;
    use library\valueobject\Book;
    use PHPUnit\Framework\TestCase;

    /**
     * Class BookTest
     * @package library\ValueObjects
     * @covers  library\valueobject\Book
     * @uses  library\exceptions\InvalidBookException
     * @uses library\requests\AbstractRequest
     */
    class BookTest extends TestCase
    {
        private $releaseDate = '1970-01-01';
        /** @var Book */
        private $book;

        /** @var AbstractRequest */
        private $request;

        /** @var \PHPUnit_Framework_MockObject_MockObject|\DateTime */
        private $dateTime;

        public function setUp()
        {
            $arr = [
                'submit' => 'Submit',
                'author' => 'Test Author',
                'title' => 'Test Title',
                'genre' => 'Test Genre',
                'price' => 1.35,
                'releaseDate' => $this->releaseDate,
                'description' => 'Test Description'
            ];

            $this->dateTime = $this->getMockBuilder(\DateTime::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->request = new PostRequest($arr, $_SERVER);
            $this->book = new Book($this->request);
        }

        public function fieldProvider()
        {
            return array(
                array('Test Author', 'getAuthor'),
                array('Test Title', 'getTitle'),
                array('Test Genre', 'getGenre'),
                array(1.35, 'getPrice'),
                array('Test Description', 'getDescription'),
            );
        }

        /**
         * @dataProvider fieldProvider
         */
        public function testBookFieldsInsertedByConstructor($expected, $methodToCall)
        {
            $this->assertEquals($expected, $this->book->{$methodToCall}());
        }

        public function testSetAndGetDateWorks()
        {
            $this->assertSame($this->releaseDate, $this->book->getReleaseDate()->format('Y-m-d'));
        }

        public function errorProvider()
        {
                return array(
                array(
                    array(
                    'submit' => 'Submit',
                    'author' => 'Test Author',
                    'title' => 'Test Title',
                    'genre' => 'Test Genre',
                    'price' => -1.35,
                    'releaseDate' => '1970-01-01',
                    'description' => 'Test Description')),
                array(
                    array(
                    'submit' => 'Submit',
                    'author' => 'Test Author',
                    'title' => 'Test Title',
                    'genre' => '',
                    'price' => 1.35,
                    'releaseDate' => '1970-01-01',
                    'description' => 'Test Description')),
                array(
                    array(
                    'submit' => 'Submit',
                    'author' => 'Test Author',
                    'title' => 'Test Title',
                    'genre' => 'Test Genre',
                    'price' => 1.35,
                    'releaseDate' => '197a0-01-01',
                    'description' => 'Test Description')),
                array(
                    array(
                    'submit' => 'Submit',
                    'title' => 'Test Title',
                    'genre' => 'Test Genre',
                    'price' => 1.35,
                    'releaseDate' => '197a0-01-01',
                    'description' => 'Test Description'))
            );
        }

        /**
         * @dataProvider errorProvider
         */
        public function testInputErrors($arr)
        {
            $this->expectException(InvalidBookException::class);
            $this->request = new PostRequest($arr, $_SERVER);
            $this->book = new Book($this->request);
        }
    }
}
