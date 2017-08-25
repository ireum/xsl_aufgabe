<?php


namespace library
{

    class DisplayBookFormProcessor implements Processor
    {
        public function __construct()
        {
        }

        public function execute(HtmlResponse $response, AbstractRequest $request)
        {
            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file(__DIR__ . '/../pages/add.xsl'));

            $dom = new \DOMDocument();
            $dom->load(__DIR__ . '/../pages/add.xml');

            $response->setBody($xslParser->transformToDoc($dom)->saveXML());
        }

    }
}
