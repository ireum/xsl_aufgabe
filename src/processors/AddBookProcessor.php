<?php

namespace library\processor
{

    use library\book\Book;
    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;
    use library\xmlhandler\XmlEditor;
    use library\xmlhandler\XmlErrorGenerator;
    use library\xmlhandler\XmlExceptionProcessor;

    class AddBookProcessor implements Processor
    {
        /** @var XmlEditor */
        private $xmlEditor;
        /** @var XmlExceptionProcessor */
        private $xmlExceptionProcessor;
        /** @var XmlErrorGenerator */
        private $xmlErrorGenerator;

        public function __construct(
            XmlEditor $xmlEditor,
            XmlExceptionProcessor $xmlExceptionProcessor,
            XmlErrorGenerator $xmlErrorGenerator
        )
        {
            $this->xmlEditor = $xmlEditor;
            $this->xmlExceptionProcessor = $xmlExceptionProcessor;
            $this->xmlErrorGenerator = $xmlErrorGenerator;
        }

        public function execute(HtmlResponse $response, AbstractRequest $request, Session $session)
        {
            $book = new Book($request);

            if (!$book->hasErrorFields()) {
                $this->xmlEditor->addBook($book);
                $session->resetErrorXml();
                $response->setRedirect('/library');
            } else {

                $dom = $this->xmlErrorGenerator->generateXml($book->getErrorFields(), $request->getInputVariables());
                $session->setErrorXml($dom);
                $response->setRedirect('/add');
            }
        }
    }
}
