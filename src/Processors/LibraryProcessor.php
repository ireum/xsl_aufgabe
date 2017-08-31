<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\handler\LibraryFilter;
    use library\session\Session;

    class LibraryProcessor implements Processor
    {

        /** @var LibraryFilter */
        private $xmlFormProcessor;
        /** @var string */
        private $xslPath;

        public function __construct(LibraryFilter $searchFormProcessor, string $xslPath)
        {
            $this->xmlFormProcessor = $searchFormProcessor;
            $this->xslPath = $xslPath;

        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request
        )
        {
            $sfp = $this->xmlFormProcessor;

            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $response->setBody($xslParser->transformToDoc($sfp->processForm($request))->saveXML());
        }
    }

}
