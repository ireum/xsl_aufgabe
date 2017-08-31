<?php

namespace library\processor
{

    use library\book\Book;
    use library\book\InvalidBookException;
    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;
    use library\xmlhandler\XmlEditor;
    use library\xmlhandler\XmlErrorGenerator;

    class AddBookProcessor implements Processor
    {
        /** @var XmlEditor */
        private $xmlEditor;
        /** @var XmlErrorGenerator */
        private $xmlErrorGenerator;

        public function __construct(
            XmlEditor $xmlEditor,
            XmlErrorGenerator $xmlErrorGenerator
        )
        {
            $this->xmlEditor = $xmlEditor;
            $this->xmlErrorGenerator = $xmlErrorGenerator;
        }

        public function execute(HtmlResponse $response, AbstractRequest $request, Session $session)
        {
            try {
                $book = new Book($request);
                $this->xmlEditor->addBook($book);
                $response->setRedirect('/library');
            } catch (InvalidBookException $e) {
                $dom = $this->xmlErrorGenerator->generateXml($e->getErrorFields(), $request);
                $session->setErrorXml($dom);
                $response->setRedirect('/add');
            }
        }
    }
}
