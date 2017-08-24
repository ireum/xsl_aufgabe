<?php


namespace library
{

    class LibraryProcessor implements Processor
    {

        /** @var XmlFormProcessor */
        private $xmlFormProcessor;
        /** @var string */
        private $xslPath;

        public function __construct(XmlFormProcessor $searchFormProcessor, string $xslPath)
        {
            $this->xmlFormProcessor = $searchFormProcessor;
            $this->xslPath = $xslPath;

        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            $sfp = $this->xmlFormProcessor;

            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $response->setBody($xslParser->transformToDoc($sfp->processForm($request))->saveXML());
        }
    }

}
