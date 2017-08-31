<?php

namespace library\factories
{

    use library\Configuration;
    use library\processor\AddBookProcessor;
    use library\processor\DisplayBookFormProcessor;
    use library\processor\ErrorPageProcessor;
    use library\processor\LibraryProcessor;
    use library\handler\BookAppender;
    use library\handler\ErrorXmlGenerator;
    use library\handler\LibraryFilter;
    use library\handler\BooksQuery;
    use library\routers\Router;

    class Factory
    {
        /** @var Configuration */
        private $configuration;

        public function __construct(Configuration $configuration)
        {
            $this->configuration = $configuration;
        }

        public function createSearchFormProcessor(): LibraryFilter
        {
            return new LibraryFilter($this->configuration->getXmlPath(), $this->createXmlProcessor());
        }

        public function createXmlEditor(): BookAppender
        {
            return new BookAppender($this->configuration->getXmlPath(), $this->createXmlProcessor());
        }

        public function createAddBookDomDoc(): \DOMDocument
        {
            $dom = new \DOMDocument();
            return $dom->load($this->configuration->getXmlAddBookPath());

        }

        public function createAddBookProcessor(): AddBookProcessor
        {
            return new AddBookProcessor($this->createXmlEditor(), $this->createErrorXmlGenerator());
        }

        public function createDisplayBookProcessor(): DisplayBookFormProcessor
        {
            return new DisplayBookFormProcessor($this->configuration->getXmlAddBookPath(), $this->configuration->getXslAddBookPath());
        }

        public function createLibraryProcessor(): LibraryProcessor
        {
            return new LibraryProcessor($this->createSearchFormProcessor(), $this->configuration->getXslPath());
        }

        public function createErrorPageProcessor(): ErrorPageProcessor
        {
            return new ErrorPageProcessor();
        }

        private function createXmlProcessor(): BooksQuery
        {
            return new BooksQuery($this->configuration->getXmlPath());
        }

        public function createRouter(): Router
        {
            return new Router($this);
        }

        public function createErrorXmlGenerator(): ErrorXmlGenerator
        {
            return new ErrorXmlGenerator($this->configuration->getXmlAddBookPath());
        }

    }
}
