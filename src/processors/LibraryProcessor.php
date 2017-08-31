<?php


namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;
    use library\xmlhandler\XmlLibraryFilter;

    class LibraryProcessor implements Processor
    {

        /** @var XmlLibraryFilter */
        private $xmlFormProcessor;
        /** @var string */
        private $xslPath;

        public function __construct(XmlLibraryFilter $searchFormProcessor, string $xslPath)
        {
            $this->xmlFormProcessor = $searchFormProcessor;
            $this->xslPath = $xslPath;

        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request,
            Session $session
        )
        {
            $sfp = $this->xmlFormProcessor;

            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $response->setBody($xslParser->transformToDoc($sfp->processForm($request))->saveXML());
        }
    }

}
