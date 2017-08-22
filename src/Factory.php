<?php

namespace library
{

    class Factory
    {
        /** @var string */
        private $path;

        public function __construct(string $path)
        {
            $this->path = $path;
        }

        public function createAddBookFormValidation(AbstractRequest $request): AddBookFormValidation
        {
            return new AddBookFormValidation($request);
        }

        public function createSearchFormProcessor(AbstractRequest $request): SearchFormProcessor
        {
            return new SearchFormProcessor($this->path, $request, $this->createXmlProcessor());
        }

        public function createXmlEditor(AbstractRequest $request): XmlEditor
        {
            return new XmlEditor($this->path, $request, $this->createXmlProcessor());
        }

        private function createXmlProcessor(): XmlProcessor
        {
            return new XmlProcessor($this->path);
        }
    }
}
