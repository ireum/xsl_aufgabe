<?php

namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\session\Session;
    use library\valueobject\Book;
    use library\handler\BookAppender;
    use library\handler\ErrorXmlGenerator;

    class AddBookProcessor implements Processor
    {
        /** @var BookAppender */
        private $xmlEditor;
        /** @var ErrorXmlGenerator */
        private $xmlErrorGenerator;

        public function __construct(
            BookAppender $xmlEditor,
            ErrorXmlGenerator $xmlErrorGenerator
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
            } catch (\library\exceptions\InvalidBookException $e) {
                $dom = $this->xmlErrorGenerator->generateXml($e->getErrorFields(), $request);
                $session->setErrorXml($dom);
                $response->setRedirect('/add');
            }
        }
    }
}
