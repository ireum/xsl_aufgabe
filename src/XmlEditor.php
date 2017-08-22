<?php


namespace library
{
    class XmlEditor
    {
        /** @var \SimpleXMLElement */
        private $sxmlElement;
        /** @var AbstractRequest */
        private $request;
        /** @var XmlProcessor */
        private $xmlProcessor;
        /** @var string */
        private $path;

        public function __construct(string $path, AbstractRequest $request, XmlProcessor $xmlProcessor)
        {
            $this->sxmlElement = $this->setSxmlElement($path);
            $this->request = $request;
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

        public function addBook()
        {
            $book = $this->getRootNode()->addChild('book');
            $book->addAttribute('id', $this->xmlProcessor->getNextId());
            $book->addChild('author', $this->request->get('author'));
            $book->addChild('title', $this->request->get('title'));
            $book->addChild('genre', $this->request->get('genre'));
            $book->addChild('price', $this->request->get('price'));
            $book->addChild('publish_date', $this->request->get('releaseDate'));
            $book->addChild('description', $this->request->get('description'));
            $this->saveBook();
        }

        private function saveBook()
        {
            $this->sxmlElement->saveXML($this->path);
        }
    }
}
