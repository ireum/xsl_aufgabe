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
        private $bookAppender;
        /** @var ErrorXmlGenerator */
        private $errorXmlGenerator;
        /** @var Session */
        private $session;
        /** @var Factory */
        private $factory;

        public function __construct(
            BookAppender $bookAppender,
            ErrorXmlGenerator $errorXmlGenerator,
            Session $session,
            Factory $factory
        )
        {
            $this->bookAppender = $bookAppender;
            $this->errorXmlGenerator = $errorXmlGenerator;
            $this->session = $session;
            $this->factory = $factory;
        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            try {
                $book = new Book($request);
                $this->bookAppender->addBook($book);
                $response->setRedirect('/library');
            } catch (InvalidBookException $e) {
                $dom = $this->errorXmlGenerator->generateXml($e->getErrorFields(), $request);
                $this->session->setErrorXml($dom);
                $response->setRedirect('/add');
            }
        }
    }
}
