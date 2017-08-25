<?php

namespace library\book
{

    use library\requests\AbstractRequest;
    use PHPUnit\Framework\TestCase;

    /**
     * Class BookTest
     * @package library\book
     * @covers library\book\Book
     */
    class BookTest extends TestCase
    {
        /** @var Book */
        private $book;

        /** @var \PHPUnit_Framework_MockObject_MockObject|AbstractRequest */
        private $request;

        public function setUp()
        {
            $this->request = $this->getMockBuilder(AbstractRequest::class)
                ->disableOriginalConstructor()
                ->getMock();

            $this->book = new Book($this->request);
        }

    }
}
