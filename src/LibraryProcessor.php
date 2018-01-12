<?php


namespace library
{

    class LibraryProcessor
    {

        /** @var SearchFormProcessor */
        private $searchFormProcessor;
        /** @var string */
        private $xslPath;

        public function __construct(SearchFormProcessor $searchFormProcessor)
        {
            $this->searchFormProcessor = $searchFormProcessor;
            $this->xslPath = __DIR__ . '/xslt.xsl';
        }

        public function execute(HtmlResponse $response)
        {
            $sfp = $this->searchFormProcessor;

            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $sfp->processForm();

            $response->setBody($xslParser->transformToDoc($sfp->getSxmlElement())->saveXML());
        }
    }

}
