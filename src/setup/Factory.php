<?php

namespace library
{

    class Factory
    {
        /** @var Configuration */
        private $configuration;

        public function __construct(Configuration $configuration)
        {
            $this->configuration = $configuration;
        }

        public function createSearchFormProcessor(): XmlFormProcessor
        {
            return new XmlFormProcessor($this->configuration->getXmlPath(), $this->createXmlProcessor());
        }

        public function createXmlEditor(): XmlEditor
        {
            return new XmlEditor($this->configuration->getXmlPath(), $this->createXmlProcessor());
        }

        public function createAddBookProcessor(): AddBookProcessor
        {
            return new AddBookProcessor($this->createXmlEditor());
        }

        public function createDisplayBookProcessor(): DisplayBookFormProcessor
        {
            return new DisplayBookFormProcessor();
        }

        public function createLibraryProcessor(): LibraryProcessor
        {
            return new LibraryProcessor($this->createSearchFormProcessor(), $this->configuration->getXslPath());
        }

        public function createErrorPageProcessor(): ErrorPageProcessor
        {
            return new ErrorPageProcessor();
        }

        private function createXmlProcessor(): XmlQuery
        {
            return new XmlQuery($this->configuration->getXmlPath());
        }


        public function createRouter()
        {
            return new Router($this);
        }

    }
}
