<?php


namespace library\processor
{

    use library\backends\FileBackend;
    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\handler\LibraryFilter;
    use library\session\Session;

    class LibraryProcessor implements Processor
    {

        /** @var LibraryFilter */
        private $libraryFilter;
        /** @var string */
        private $xslPath;
        /** @var FileBackend */
        private $fileBackend;

        public function __construct(LibraryFilter $libraryFilter, string $xslPath,FileBackend $fileBackend)
        {
            $this->libraryFilter = $libraryFilter;
            $this->xslPath = $xslPath;

            $this->fileBackend = $fileBackend;
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request
        )
        {
            $sfp = $this->libraryFilter;

            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_string($this->fileBackend->load($this->xslPath))); //TODO: X Via FileBackend

            $response->setBody($xslParser->transformToDoc($sfp->processForm($request))->saveXML());
        }
    }

}
