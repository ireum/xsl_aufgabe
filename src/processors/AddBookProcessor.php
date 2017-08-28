<?php

namespace library\processor
{


    use library\book\Book;
    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\xmlhandler\XmlEditor;
    use library\xmlhandler\XmlExceptionProcessor;

    class AddBookProcessor implements Processor
    {
        /** @var XmlEditor */
        private $xmlEditor;
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
