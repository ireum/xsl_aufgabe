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

        public function createAddBookFormValidation(AbstractRequest $request): AddBookFormValidation
        {
            return new AddBookFormValidation($request);
        }

        public function createSearchFormProcessor(AbstractRequest $request): SearchFormProcessor
        {
            return new SearchFormProcessor($this->configuration->getXmlPath(), $request, $this->createXmlProcessor());
        }

        public function createXmlEditor(AbstractRequest $request): XmlEditor
        {
            return new XmlEditor($this->configuration->getXmlPath(), $request, $this->createXmlProcessor());
        }

        public function createAddBookProcessor(
            AbstractRequest $request
        ): AddBookProcessor
        {
            return new AddBookProcessor($request, $this->createAddBookFormValidation($request), $this->createXmlEditor($request));
        }

        public function createLibraryProcessor(AbstractRequest $request): LibraryProcessor
        {
            return new LibraryProcessor($this->createSearchFormProcessor($request), $this->configuration->getXslPath());
        }

        public function createErrorPageProcessor(): ErrorPageProcessor
        {
            return new ErrorPageProcessor();
        }

        private function createXmlProcessor(): XmlProcessor
        {
            return new XmlProcessor($this->configuration->getXmlPath());
        }
    }
}
