<?php

namespace library\processor
{

    use library\exceptions\InvalidBookException;
    use library\factories\Factory;
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
        /** @var Session */
        private $session;
        /** @var Factory */
        private $factory;

        public function __construct(
            BookAppender $xmlEditor,
            ErrorXmlGenerator $xmlErrorGenerator,
            Session $session,
            Factory $factory
        )
        {
            $this->xmlEditor = $xmlEditor;
            $this->xmlErrorGenerator = $xmlErrorGenerator;
            $this->session = $session;
            $this->factory = $factory;
        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            try {
//                $book = new Book($request);
                $book = $this->factory->createBook($request);
                $this->xmlEditor->addBook($book);
                $response->setRedirect('/library');
            } catch (InvalidBookException $e) {
                $dom = $this->xmlErrorGenerator->generateXml($e->getErrorFields(), $request);
                $this->session->setErrorXml($dom);
                $response->setRedirect('/add');
            }
        }
    }
}
