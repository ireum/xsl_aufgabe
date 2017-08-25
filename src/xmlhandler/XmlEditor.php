<?php


namespace library\xmlhandler
{

    use library\book\Book;

    class XmlEditor
    {
        /** @var \SimpleXMLElement */
        private $sxmlElement;
        /** @var XmlQuery */
        private $xmlProcessor;
        /** @var string */
        private $path;

        public function __construct(string $path, XmlQuery $xmlProcessor)
        {
            $this->sxmlElement = $this->setSxmlElement($path);
            $this->xmlProcessor = $xmlProcessor;
            $this->path = $path;
        }

        private function setSxmlElement(string $path)
        {
            if (!simplexml_load_file($path)) {
                throw new \InvalidArgumentException('Invalid path');
            }
            return simplexml_load_file($path);
        }

        private function getRootNode()
        {
            return $this->sxmlElement->xpath('/catalog')[0];
        }

        public function addBook(Book $book)
        {
            $node = $this->getRootNode()->addChild('book');
            $node->addAttribute('id', $this->xmlProcessor->getNextId());
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
            $this->sxmlElement->saveXML($this->path);
        }
    }
}
