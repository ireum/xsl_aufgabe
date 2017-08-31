<?php

namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\routing\HtmlResponse;
    use library\routing\Session;

    class DisplayBookFormProcessor implements Processor
    {

        /** @var string */
        private $xmlPath;
        /** @var string */
        private $xslPath;

        public function __construct(string $xmlPath, string $xslPath)
        {
            $this->xmlPath = $xmlPath;
            $this->xslPath = $xslPath;
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request,
            Session $session
        )
        {
            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $dom = new \DOMDocument();
            if ($session->hasError()) {
              $dom = $session->getErrorXml();

            } else {
                $dom->load($this->xmlPath);
            }
            $response->setBody($xslParser->transformToDoc($dom)->saveXML());
            $session->resetErrorXml();
        }

    }
}

