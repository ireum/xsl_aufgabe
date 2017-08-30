<?php

namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;

    class DisplayBookFormProcessor implements Processor
    {
        public function __construct()
        {
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request,
            Session $session
        )
        {
            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file(__DIR__ . '/../pages/add.xsl'));

            $dom = new \DOMDocument();
            if ($session->hasError()) {
                $dom = $session->generateErrorXml();
                $session->resetErrorXml();
                session_destroy();

            } else {
                $dom->load(__DIR__ . '/../pages/add.xml');
            }
            $response->setBody($xslParser->transformToDoc($dom)->saveXML());
            $session->resetErrorXml();


        }

    }
}

