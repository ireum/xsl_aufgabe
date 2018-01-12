<?php

namespace library\processor
{

    use library\requests\AbstractRequest;
    use library\responder\HtmlResponse;
    use library\session\Session;

    class DisplayBookFormProcessor implements Processor
    {

        /** @var string */
        private $xmlPath;
        /** @var string */
        private $xslPath;
        /** @var Session */
        private $session;

        public function __construct(string $xmlPath, string $xslPath, Session $session)
        {
            $this->xmlPath = $xmlPath;
            $this->xslPath = $xslPath;
            $this->session = $session;
        }

        public function execute(
            HtmlResponse $response,
            AbstractRequest $request
        )
        {
            $xslParser = new \XSLTProcessor();
            $xslParser->importStylesheet(simplexml_load_file($this->xslPath));

            $dom = new \DOMDocument();
            if ($this->session->hasError()) {
              $dom = $this->session->getErrorXml();

            } else {
                $dom->load($this->xmlPath);
            }
            $response->setBody($xslParser->transformToDoc($dom)->saveXML());
            $this->session->resetErrorXml();
        }

    }
}

