<?php


namespace library\handler
{


    use library\valueobject\Book;

    class BookAppender
    {
        /** @var \SimpleXMLElement */
        private $sxmlElement;
        /** @var BooksQuery */
        private $xmlQuery;
        /** @var string */
        private $xmlPath;

        public function __construct(string $xmlPath, BooksQuery $xmlQuery)
        {
            $this->sxmlElement = $this->setSxmlElement($xmlPath);
            $this->xmlQuery = $xmlQuery;
            $this->xmlPath = $xmlPath;
        }

        private function setSxmlElement(string $xmlPath): \SimpleXMLElement
        {
            if (!simplexml_load_file($xmlPath)) {
                throw new \InvalidArgumentException('Invalid path');
            }
            return simplexml_load_file($xmlPath);
        }

        private function getRootNode(): \SimpleXMLElement
        {
            return $this->sxmlElement->xpath('/catalog')[0];
        }

        public function addBook(Book $book)
        {
            $node = $this->getRootNode()->addChild('book');
            $node->addAttribute('id', $this->xmlQuery->getNextId());
            $node->addChild('author', $book->getAuthor());
            $node->addChild('title', $book->getTitle());
            $node->addChild('genre', $book->getGenre());
            $node->addChild('price', $book->getPrice());
            $node->addChild('publish_date', $book->getReleaseDate()->format('Y-m-d'));
            $node->addChild('description', $book->getDescription());
            $this->saveBook();
        }

        private function saveBook()
        {
            $this->sxmlElement->saveXML($this->xmlPath);
        }
    }
}
