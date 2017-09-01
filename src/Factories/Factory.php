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
    use library\session\Session;

    class Factory
    {
        /** @var Configuration */
        private $configuration;

        /** @var Session */
        private $session;

        public function __construct(Configuration $configuration, Session $session)
        {
            $this->configuration = $configuration;
            $this->session = $session;
        }

        public function createLibraryFilter(): LibraryFilter
        {
            return new LibraryFilter($this->configuration->getXmlPath(), $this->createXmlProcessor());
        }

        public function createBookAppender(): BookAppender
        {
            return new BookAppender($this->configuration->getXmlPath(), $this->createXmlProcessor());
        }

        public function createAddBookProcessor(): AddBookProcessor
        {
            return new AddBookProcessor(
                $this->createBookAppender(),
                $this->createErrorXmlGenerator(),
                $this->session
            );
        }

        public function createDisplayBookProcessor(): DisplayBookFormProcessor
        {
            return new DisplayBookFormProcessor(
                $this->configuration->getXmlAddBookPath(),
                $this->configuration->getXslAddBookPath(),
                $this->session
            );
        }

        public function createLibraryProcessor(): LibraryProcessor
        {
            return new LibraryProcessor($this->createLibraryFilter(), $this->configuration->getXslPath());
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
