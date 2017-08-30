<?php

namespace library\processor
{

    use library\book\Book;
    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;
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

        public function execute(HtmlResponse $response, AbstractRequest $request, Session $session)
        {
            $book = new Book($request);

            if (!$book->hasErrorFields()) {
                echo 'IF';
                $this->xmlEditor->addBook($book);
                $session->resetErrorXml();
                $response->setRedirect('/library');
            } else {
                $_SESSION['errorFields'] = $book->getErrorFields();
                $_SESSION['request'] = $_POST;
                $response->setRedirect('/add');
            }
        }
    }
}
