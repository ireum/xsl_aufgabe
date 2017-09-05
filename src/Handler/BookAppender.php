<?php


namespace library\handler
{


    use library\backends\FileBackend;
    use library\valueobject\Book;

    class BookAppender
    {
        /** @var \SimpleXMLElement */
        private $sxmlElement;
        /** @var BooksQuery */
        private $xmlQuery;
        /** @var string */
        private $xmlPath;
        /** @var FileBackend */
        private $fileBackend;

        public function __construct(string $xmlPath, BooksQuery $xmlQuery, FileBackend $fileBackend)
        {
            $this->fileBackend = $fileBackend;
            $this->setSxmlElement($xmlPath);
            $this->xmlQuery = $xmlQuery;
            $this->xmlPath = $xmlPath;
        }

        private function setSxmlElement(string $xmlPath)
        {
            $this->isValidIniFile($xmlPath);
//            var_dump($this->fileBackend->load($xmlPath));exit('hitme');
            $this->sxmlElement = simplexml_load_string($this->fileBackend->load($xmlPath));

        }

        private function isValidIniFile(string $xmlPath)
        {
            set_error_handler(
                create_function(
                    '$severity, $message, $file, $line',
                    'throw new library\exceptions\ErrorException($message, $severity, $severity, $file, $line);'
                )
            );
            parse_ini_file($xmlPath, true, INI_SCANNER_TYPED);
            restore_error_handler();
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
            $this->fileBackend->save($this->xmlPath, $this->sxmlElement->asXML());
        }
    }
}
