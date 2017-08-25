<?php

// TODO: add DIR Namespace
namespace library
{


    class AddBookProcessor implements Processor
    {
        /** @var XmlEditor */
        private $xmlEditor;
        /** @var \DOMDocument */
        /** @var XmlExceptionProcessor */
        private $xmlExceptionProcessor;

        public function __construct(XmlEditor $xmlEditor, XmlExceptionProcessor $xmlExceptionProcessor)
        {
            $this->xmlEditor = $xmlEditor;
            $this->xmlExceptionProcessor = $xmlExceptionProcessor;
        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            try {
                $this->xmlExceptionProcessor->resetException();
                $book = new Book($request);
                $this->xmlEditor->addBook($book);
                $response->setRedirect('/library');

            } catch (\InvalidArgumentException $e) {

                $this->xmlExceptionProcessor->processFormException($e, $request);
                $response->setRedirect('/add');
            }
        }
    }
}
