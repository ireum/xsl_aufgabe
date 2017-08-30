<?php

namespace library\setup
{

    use library\processor\AddBookProcessor;
    use library\processor\DisplayBookFormProcessor;
    use library\processor\ErrorPageProcessor;
    use library\processor\LibraryProcessor;
    use library\routing\Router;
    use library\routing\Session;
    use library\xmlhandler\XmlEditor;
    use library\xmlhandler\XmlErrorGenerator;
    use library\xmlhandler\XmlExceptionProcessor;
    use library\xmlhandler\XmlFormProcessor;
    use library\xmlhandler\XmlQuery;

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

        public function createAddBookDomDoc(): \DOMDocument
        {
            $dom = new \DOMDocument();
            return $dom->load($this->configuration->getXmlAddBookPath());

        }

        public function createXmlExceptionProcessor(): XmlExceptionProcessor
        {
            return new XmlExceptionProcessor();
        }

        public function createAddBookProcessor(): AddBookProcessor
        {
            return new AddBookProcessor($this->createXmlEditor(), $this->createXmlExceptionProcessor(), $this->createXmlErrorGenerator());
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

        public function createXmlErrorGenerator(): XmlErrorGenerator
        {
            return new XmlErrorGenerator();
        }

    }
}
