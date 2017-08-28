<?php

namespace library\book
{

    use library\requests\AbstractRequest;
    use library\requests\PostRequest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class BookTest
     * @package library\book
     * @covers library\book\Book
     * @uses library\requests\AbstractRequest
     */
    class BookTest extends TestCase
    {
        /** @var Book */
        private $book;

        /** @var AbstractRequest */
        private $request;

        public function setUp()
        {

            $arr = [
                'submit' => 'Submit',
                'author' => 'Test Author',
                'title' => 'Test Title',
                'genre' => 'Test Genre',
                'price' => 1.35,
                'releaseDate' => '1970-01-01',
                'description' => 'Test Description'
            ];

            $this->request = new PostRequest($arr);
            $this->book = new Book($this->request);
        }

        public function testValidateStringThrowsExceptionIfStringIsInvalid()
        {
            $this->expectException(\InvalidArgumentException::class);

            $arr = [
                'submit' => 'Submit',
                'author' => '',
                'title' => 'Test Title',
                'genre' => 'Test Genre',
                'price' => 1.35,
                'releaseDate' => '1970-01-01',
                'description' => 'Test Description'
            ];

            $this->request = new PostRequest($arr);
            $this->book = new Book($this->request);
        }

        public function testValidateDateThrowsInvalidArgumentExceptionIfDateIsInvalid()
        {
            $this->expectException(\InvalidArgumentException::class);

            $arr = [
                'submit' => 'Submit',
                'author' => 'Test Author',
                'title' => 'Test Title',
                'genre' => 'Test Genre',
                'price' => 1.35,
                'releaseDate' => 'as70-01-01',
                'description' => 'Test Description'
            ];

            $this->request = new PostRequest($arr);
            $this->book = new Book($this->request);

        }

        public function testValidatePriceThrowsInvalidArgumentExceptionIfPriceIsInvalid()
        {
            $this->expectException(\InvalidArgumentException::class);

            $arr = [
                'submit' => 'Submit',
                'author' => 'Test Author',
                'title' => 'Test Title',
                'genre' => 'Test Genre',
                'price' => -1.35,
                'releaseDate' => 'as70-01-01',
                'description' => 'Test Description'
            ];

            $this->request = new PostRequest($arr);

            $this->book = new Book($this->request);
        }

        public function testGetAuthorReturnsAuthorInsertedByConstructor()
        {
            $this->assertEquals('Test Author', $this->book->getAuthor());
        }

        public function testGetTitleReturnsTitleInsertedByConstructor()
        {
            $this->assertEquals('Test Title', $this->book->getTitle());
        }

        public function testGetGenreReturnsGenreInsertedByConstructor()
        {
            $this->assertEquals('Test Genre', $this->book->getGenre());
        }

        public function testGetPriceReturnsPriceInsertedByConstructor()
        {
            $this->assertEquals(1.35, $this->book->getPrice());
        }

        public function testGetDateReturnsDateInsertedByConstructor()
        {
            $dt = \DateTime::createFromFormat('Y-m-d', '1970-01-01');
            $this->assertEquals($dt, $this->book->getReleaseDate());
        }

        public function testGetDescriptionReturnsDescriptionInsertedByConstructor()
        {
            $this->assertEquals('Test Description', $this->book->getDescription());
        }
    }
}
