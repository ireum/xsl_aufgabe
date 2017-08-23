<?php


namespace library
{

    class AddBookProcessor
    {
        /** @var AbstractRequest */
        private $request;
        /** @var AddBookFormValidation */
        private $formValidation;
        /** @var XmlEditor */
        private $xmlEditor;

        public function __construct(AbstractRequest $request, AddBookFormValidation $formValidation, XmlEditor $xmlEditor)
        {
            $this->request = $request;
            $this->formValidation = $formValidation;
            $this->xmlEditor = $xmlEditor;
        }

        private function checkIfRequested(): bool
        {
            if (
                $this->request->has('submit') &&
                $this->request->get('author') &&
                $this->request->get('title') &&
                $this->request->get('genre') &&
                $this->request->get('price') &&
                $this->request->get('releaseDate') &&
                $this->request->get('description')
            ) {
                return true;
            }
            return false;
        }

        public function execute(HtmlResponse $response)
        {
            if ($this->checkIfRequested() && $this->formValidation->isValid()) {
                $this->xmlEditor->addBook();
                //TODO: Via Response Objekt. $response->setRedirect .z.b oder $response->setHeader()
                header('Location: /library');
            }

            $xml = simplexml_load_file('add.xml');

            $response->setBody($xml->saveXML());
        }
    }
}
