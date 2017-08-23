<?php


namespace library
{

    class AddBookProcessor implements Processor
    {
        /** @var XmlEditor */
        private $xmlEditor;

        public function __construct(XmlEditor $xmlEditor)
        {
            $this->xmlEditor = $xmlEditor;
        }

        private function checkIfRequested(AbstractRequest $request): bool
        {
            if (
                $request->has('submit') &&
                $request->get('author') &&
                $request->get('title') &&
                $request->get('genre') &&
                $request->get('price') &&
                $request->get('releaseDate') &&
                $request->get('description')
            ) {
                return true;
            }
            return false;
        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            try {

                if ($this->checkIfRequested($request)) {

                    $book = new Book($request);

                    $this->xmlEditor->addBook($book);
                    $response->setRedirect('/library');
                }
            } catch (\InvalidArgumentException $e) {
                echo $e->getMessage();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $xml = simplexml_load_file('add.xml');

            $response->setBody($xml->saveXML());
        }
    }
}
